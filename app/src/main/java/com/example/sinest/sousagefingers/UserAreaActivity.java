package com.example.sinest.sousagefingers;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.EditText;
import android.widget.TextView;

public class UserAreaActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_area);

        final TextView tvWelcomeMsg = (TextView) findViewById(R.id.tvLog);
        final EditText etUser = (EditText) findViewById(R.id.etUser);


        Intent intent = getIntent();
        String name = intent.getStringExtra("name");

        tvWelcomeMsg.setText(tvWelcomeMsg.getText().toString() + " " + name);

        etUser.setText(name);

    }
}
