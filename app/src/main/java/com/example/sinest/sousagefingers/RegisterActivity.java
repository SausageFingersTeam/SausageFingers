package com.example.sinest.sousagefingers;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Response;

import org.json.JSONException;
import org.json.JSONObject;

public class RegisterActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        final EditText etName = (EditText) findViewById(R.id.etName);
        final EditText etLastName = (EditText) findViewById(R.id.etLastName);
        final EditText etDriverNr = (EditText) findViewById(R.id.etDriverNr);
        final EditText etEmail = (EditText) findViewById(R.id.etEmail);
        final EditText etPassword = (EditText) findViewById(R.id.etPassword);

        final Button bRegister = (Button) findViewById(R.id.bRegister);

        bRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                final String first_name = etName.getText().toString();
                final String last_name = etLastName.getText().toString();
                final String driver_license = etDriverNr.getText().toString();
                final String email = etEmail.getText().toString();
                final String password = etPassword.getText().toString();

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            response = response.substring(response.indexOf("{"));
                            JSONObject jsonResponse = new JSONObject(response);
                            Toast.makeText(getApplicationContext(), jsonResponse.getString("message"), Toast.LENGTH_LONG).show();

                            if(jsonResponse.getString("message").equals("Registered Successfully! :)") || jsonResponse.getString("message").equals("User already Exists, Please Login.") ){
                                Intent intent = new Intent(RegisterActivity.this, LoginActivity.class);
                                RegisterActivity.this.startActivity(intent);
                            }else{
                                AlertDialog.Builder builder = new AlertDialog.Builder(RegisterActivity.this);
                                builder.setMessage("Register Failed!")
                                        .setNegativeButton("Retry", null)
                                        .create()
                                        .show();
                            }

                        }catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                };

                RegisterRequest registerRequest = new RegisterRequest(first_name, last_name, driver_license, email, password, responseListener);
                RequestHandler.getInstance(RegisterActivity.this).addToRequestQueue(registerRequest);
                //TODO RequestQueue queue = Volley.newRequestQueue(RegisterActivity.this);
                //TODO queue.add(registerRequest);

            }
        });

    }
}
