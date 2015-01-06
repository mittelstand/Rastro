package com.example.rastro;

import Thread.*;
import android.app.*;
import android.content.*;
import android.os.*;
import android.widget.*;

public class Intro extends Activity{
	ProgressDialog dialog = null;
	loginThread lT;
	FacebookLoginThread Flt;
	RbPreference pref;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.intro);
		Handler handler =new android.os.Handler();
		handler.postDelayed(new Runnable() {
			
			@Override
			public void run() {
				// TODO Auto-generated method stub
				
				autoLogin();
				finish();
			}
		}, 1000);
	}
	public void autoLogin(){
		pref = new RbPreference(Intro.this);
		if(pref.getValue("pwd", "")=="" && pref.getValue("id", "")==""){
			Intent intent = new Intent(Intro.this,JoinForm.class);
			startActivity(intent);
		}if(pref.getValue("pwd","")!=""){
			String email1 = pref.getValue("email", "");
			String pwd1 = pref.getValue("pwd", "");
			String url = "http://rastro.kr/app/loginChk.php";
//			dialog = ProgressDialog.show(Intro.this, "", "Loading.....");
			lT = new loginThread(email1, pwd1, url, mHandler,dialog);
			lT.start();
		}if(pref.getValue("id", "")!=""){
			String id1 = pref.getValue("id", "");
			String url="http://rastro.kr/app/appFbLoginChk.php";
//			dialog = ProgressDialog.show(Intro.this, "", "Loading.....");
			Flt = new FacebookLoginThread(mHandler, url,id1);
			Flt.start();
		}
	}
	Handler mHandler = new Handler(){
		public void handleMessage(Message msg){
			
			if(msg.what==3){
				
				Bundle bundle = msg.getData();
				Intent intent = new Intent(Intro.this,profileForm.class);
				intent.putExtra("name",bundle.getString("name"));
				intent.putExtra("email",bundle.getString("email"));
				intent.putExtra("dob",bundle.getString("dob"));
				intent.putExtra("sex",bundle.getString("sex"));
				intent.putExtra("idx",bundle.getString("idx"));
				startActivity(intent);
				finish();
//				dialog.dismiss();
				lT.interrupt();
				
			}
		
			if(msg.what==7){
				
				Bundle bundle = msg.getData();

				Intent intent = new Intent(Intro.this,profileForm.class);
				intent.putExtra("name",bundle.getString("name"));
				intent.putExtra("email",bundle.getString("email"));
				intent.putExtra("dob",bundle.getString("dob"));
				intent.putExtra("sex",bundle.getString("sex"));
				intent.putExtra("idx",bundle.getString("idx"));
				startActivity(intent);
				finish();
//				dialog.dismiss();
				Flt.interrupt();
				
			}
		}
	};
}
