package com.example.rastro;

import java.util.*;

import utility.*;
import Thread.*;
import android.app.*;
import android.content.*;
import android.os.*;
import android.view.*;
import android.view.View.OnClickListener;
import android.widget.*;

import com.facebook.*;
import com.facebook.model.*;

public class loginForm extends Activity{
	String email,pwd,id;
	EditText editEmail,editPwd;
	Button login,fblogin;
	loginThread lT;
	TextView joinTv;
	RbPreference pref;
	FacebookLoginThread Flt;
	ProgressDialog dialog = null;
	BackPressCloseHandler bpch;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.loginform);
		 editPwd = (EditText)findViewById(R.id.editPwd);
		 editEmail = (EditText)findViewById(R.id.editEmail);
		 joinTv = (TextView)findViewById(R.id.joinTv);
		 bpch=new BackPressCloseHandler(loginForm.this); 
		 joinTv.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				startActivity(new Intent(loginForm.this,JoinForm.class));
				finish();
			}
		});
	}
	public void loginform(View v){
		switch (v.getId()) {
		case R.id.login:
			email = editEmail.getText().toString();
			pwd = editPwd.getText().toString();
			String url = "http://rastro.kr/app/loginChk.php";
			dialog = ProgressDialog.show(loginForm.this, "", "Loading.....");
			lT = new loginThread(email, pwd, url, mHandler,dialog);
			lT.start();
			break;
		case R.id.fblogin:
			dialog = ProgressDialog.show(loginForm.this, "", "Loading.....");
			FacebookLogin();
		}
	}
	//페이스북 로그인연동부분
	public void FacebookLogin(){
		Session.openActiveSession(loginForm.this,true, new Session.StatusCallback() {	
			@Override
			public void call(Session session, SessionState state, Exception exception) {
				// TODO Auto-generated method stub
				if(session.isOpened()){
					if(!session.getPermissions().contains("email")) {

					String[] PERMISSION_ARRAY_READ = {"email","user_birthday"};

					List<String> PERMISSION_LIST=Arrays.asList(PERMISSION_ARRAY_READ);

					session.requestNewReadPermissions(

					new Session.NewPermissionsRequest(loginForm.this, PERMISSION_LIST));

					}
					Request.executeMeRequestAsync(session, new Request.GraphUserCallback() {
						
						@Override
						public void onCompleted(GraphUser user, Response response) {
							// TODO Auto-generated method stub
							if(user!=null){
		
								id = user.getId().toString();
								String url ="http://rastro.kr/app/appFbLoginChk.php";
								
								Flt = new FacebookLoginThread(mHandler, url,id);
								Flt.start();
							}
						}
					});
				}
			}
		});
	}
	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		// TODO Auto-generated method stub
		super.onActivityResult(requestCode, resultCode, data);
		Session.getActiveSession().onActivityResult(loginForm.this, requestCode, resultCode, data);
	}
	Handler mHandler = new Handler(){
		public void handleMessage(Message msg){ 
			if(msg.what==0){
				Toast.makeText(loginForm.this,getString(R.string.loginerror),Toast.LENGTH_SHORT).show();
				
				editEmail.setText("");
				editPwd.setText("");
				editEmail.setFocusable(true);
				editEmail.requestFocus();
				dialog.dismiss();
			
				
			}
			if(msg.what==3){
				pref = new RbPreference(loginForm.this);
				pref.put("email", email);
				pref.put("pwd", pwd);
				pref.put("id", id);
				Bundle bundle = msg.getData();

				
				Intent intent = new Intent(loginForm.this,profileForm.class);
				intent.putExtra("name",bundle.getString("name"));
				intent.putExtra("email",bundle.getString("email"));
				intent.putExtra("dob",bundle.getString("dob"));
				intent.putExtra("sex",bundle.getString("sex"));
				intent.putExtra("idx",bundle.getString("idx"));
				intent.putExtra("Ps",bundle.getString("Ps"));
				startActivity(intent);
				finish();
				dialog.dismiss();
				lT.interrupt();
				
			}
			if(msg.what==7){
				pref = new RbPreference(loginForm.this);
				Bundle bundle = msg.getData();
				
				pref.put("id", id);				
				Intent intent = new Intent(loginForm.this,profileForm.class);
				intent.putExtra("name",bundle.getString("name"));
				intent.putExtra("email",bundle.getString("email"));
				intent.putExtra("dob",bundle.getString("dob"));
				intent.putExtra("sex",bundle.getString("sex"));
				intent.putExtra("idx",bundle.getString("idx"));
				intent.putExtra("Ps",bundle.getString("Ps"));
				startActivity(intent);
				finish();
				dialog.dismiss();
				Flt.interrupt();
				
			}
			if(msg.what==5){
			dialog.dismiss();
			Toast.makeText(loginForm.this, "연결 실패", Toast.LENGTH_SHORT).show();
			}
		}
	};
	
	@Override
	public void onBackPressed() {
		// TODO Auto-generated method stub
		
		bpch.onBackPressed();
	}
}
