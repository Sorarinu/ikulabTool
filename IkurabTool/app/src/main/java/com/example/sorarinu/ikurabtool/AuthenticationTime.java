package com.example.sorarinu.ikurabtool;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;

/**
 * Created by Sorarinu on 2017/04/16.
 */

public class AuthenticationTime {
    public String getTime() {
        final DateFormat df = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
        final Date date = new Date(System.currentTimeMillis());

        return df.format(date);
    }
}
