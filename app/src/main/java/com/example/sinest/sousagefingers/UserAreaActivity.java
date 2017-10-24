package com.example.sinest.sousagefingers;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.EditText;
import android.widget.TextView;

public class UserAreaActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_area);

        final TextView tvWelocomeMsg = (TextView) findViewById(R.id.tvWelcomeMsg);

        final EditText etUser = (EditText) findViewById(R.id.etUser);
    }
}
