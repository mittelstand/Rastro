package com.example.test;

import android.app.*;
import android.os.*;
import android.view.*;
import android.view.View.OnClickListener;
import android.widget.*;

public class jsonTest extends Activity{
	Button testBtn;
	TextView Test;
	String result="";
	private String url = "http://rastro.kr/minTest.php";
			
@Override
protected void onCreate(Bundle savedInstanceState) {
	// TODO Auto-generated method stub
	super.onCreate(savedInstanceState);
	setContentView(R.layout.jsontest);
	testBtn = (Button)findViewById(R.id.testBtn);
	Test = (TextView)findViewById(R.id.Test);

	testBtn.setOnClickListener(new OnClickListener() {
		@Override
		public void onClick(View v) {
			// TODO Auto-generated method stub
			JsonThread Jt =new JsonThread(mHeader, url);
			Jt.start();
			
		}
	});
}
Handler mHeader  = new Handler(){
	public void handleMessage(Message msg){
		 
	 }
};
 


}
