package com.example.test;

import android.app.*;
import android.content.*;
import android.graphics.Paint.*;
import android.os.*;
import android.view.*;
import android.view.View.OnClickListener;
import android.widget.*;

public class MainActivity extends Activity {
	Button joinbtn,josnTest;
	EditText etId;
	EditText etPw;
	String id;
	String pw;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		joinbtn = (Button)findViewById(R.id.join);
		joinbtn.setOnClickListener(new OnClickListener() {
		
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
			Intent intent = new Intent(MainActivity.this,join.class);
			startActivity(intent);
		
			}
		});
		josnTest=(Button)findViewById(R.id.josnTest);
		josnTest.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				startActivity(new Intent(MainActivity.this,jsonTest.class));
				
			}
		});
	}
	
}
