package com.example.test2;

import android.app.*;
import android.content.*;
import android.os.*;
import android.view.*;

public class MainActivity extends Activity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		
	}
	public void mOnclick(View v){
		switch (v.getId()) {
		case R.id.aa:
			Intent intent = new Intent(MainActivity.this,test.class);
			startActivity(intent);
			
			break;

		default:
			break;
		}
			
		
			
	}
}
