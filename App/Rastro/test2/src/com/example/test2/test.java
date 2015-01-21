package com.example.test2;

import android.app.*;
import android.os.*;
import android.view.*;
import android.widget.*;

public class test extends Activity{
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.test);
		getActionBar().setTitle("테스트");
		getActionBar().setHomeButtonEnabled(true);
		
	}
	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		// TODO Auto-generated method stub
		
		switch (item.getItemId()) {
		case android.R.id.home:
			Toast.makeText(this, "text", Toast.LENGTH_SHORT).show();
			break;

		default:
			break;
		}
		return true;
	}
	
}
