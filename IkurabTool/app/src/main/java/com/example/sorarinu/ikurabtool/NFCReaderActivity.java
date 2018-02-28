package com.example.sorarinu.ikurabtool;

import android.app.PendingIntent;
import android.content.Intent;
import android.content.IntentFilter;
import android.nfc.NfcAdapter;
import android.nfc.Tag;
import android.nfc.tech.NfcF;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class NFCReaderActivity extends AppCompatActivity {
    private IntentFilter[] intentFiltersArray;
    private String[][] techListsArray;
    private NfcAdapter mAdapter;
    private PendingIntent pendingIntent;
    private NfcReader nfcReader = new NfcReader();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_nfcreader);

        pendingIntent = PendingIntent.getActivity(
                this, 0, new Intent(this, getClass()).addFlags(Intent.FLAG_ACTIVITY_SINGLE_TOP), 0);

        IntentFilter ndef = new IntentFilter(NfcAdapter.ACTION_NDEF_DISCOVERED);

        try {
            ndef.addDataType("text/plain");
        }
        catch (IntentFilter.MalformedMimeTypeException e) {
            throw new RuntimeException("fail", e);
        }
        intentFiltersArray = new IntentFilter[] {ndef};

        techListsArray = new String[][] {
                new String[] { NfcF.class.getName() }
        };

        mAdapter = NfcAdapter.getDefaultAdapter(getApplicationContext());
    }

    @Override
    protected void onResume() {
        super.onResume();
        mAdapter.enableForegroundDispatch(this, pendingIntent, intentFiltersArray, techListsArray);
    }

    @Override
    protected void onNewIntent(Intent intent) {
        Tag tag = intent.getParcelableExtra(NfcAdapter.EXTRA_TAG);
        if (tag == null) {
            return;
        }

        final AuthenticationTime authenticationTime = new AuthenticationTime();   //入退室時間

        NfcReader nfcReader = new NfcReader();
        byte[][] data = nfcReader.readTag(tag);

        String str = new String(data[0]);   //学籍番号

        String regex = "([A-Z]{1}\\d{7})";
        Pattern p = Pattern.compile(regex);
        final Matcher m1 = p.matcher(str);

        if (m1.find()) {
            new Thread(new Runnable() {
                @Override
                public void run() {
                    try {
                        URL url = new URL("http://warhol.ikulab.org/ikulab/api/v1/add?studentId=" + m1.group(0) + "&time=" + authenticationTime.getTime());
                        HttpURLConnection con = (HttpURLConnection)url.openConnection();
                        String str = InputStreamToString(con.getInputStream());
                        Log.d("HTTP", str);
                    } catch(Exception ex) {
                        System.out.println(ex);
                    }
                }
            }).start();

            Toast.makeText(this, "Success!\r\n学籍番号：" + m1.group(0) + "\r\n" + authenticationTime.getTime(), Toast.LENGTH_LONG).show();
        }
    }

    static String InputStreamToString(InputStream is) throws IOException {
        BufferedReader br = new BufferedReader(new InputStreamReader(is));
        StringBuilder sb = new StringBuilder();
        String line;
        while ((line = br.readLine()) != null) {
            sb.append(line);
        }
        br.close();
        return sb.toString();
    }

    @Override
    protected void onPause() {
        super.onPause();
        mAdapter.disableForegroundDispatch(this);
    }
}