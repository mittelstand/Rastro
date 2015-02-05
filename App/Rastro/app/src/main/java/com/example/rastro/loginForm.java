package com.example.rastro;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.facebook.Request;
import com.facebook.Response;
import com.facebook.Session;
import com.facebook.SessionState;
import com.facebook.model.GraphUser;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.Arrays;
import java.util.List;

import Thread.FacebookLoginThread;
import Thread.loginThread;
import utility.BackPressCloseHandler;
import utility.RbPreference;

public class loginForm extends Activity{
	String email,pwd,id,email2;
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
		 bpch= new BackPressCloseHandler(loginForm.this); 
		 
		 joinTv.setOnClickListener(new OnClickListener() {
			 //가입화면으로 가기
			@Override
			public void onClick(View v) {//가입 화면으로 돌아가기
				// TODO Auto-generated method stub
				startActivity(new Intent(loginForm.this,JoinForm.class));
				finish();
			}
		});
	}
	public void loginform(View v){
		switch (v.getId()) {
		case R.id.login://일반 로그인 버튼
			email = editEmail.getText().toString();
			pwd = editPwd.getText().toString();
			String url = "http://rastro.kr/app/loginChk.php";
			dialog = ProgressDialog.show(loginForm.this, "", "Loading.....");
			lT = new loginThread(email, pwd, url, mHandler,dialog);//일반 로그인 쓰레드
			lT.start();
			break;
		case R.id.fblogin: //페이스북 로그인 버튼
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

					String[] PERMISSION_ARRAY_READ = {"email"};

					List<String> PERMISSION_LIST= Arrays.asList(PERMISSION_ARRAY_READ);

					session.requestNewReadPermissions(

					new Session.NewPermissionsRequest(loginForm.this, PERMISSION_LIST));

					}
					Request.executeMeRequestAsync(session, new Request.GraphUserCallback() {
						
						@Override
						public void onCompleted(GraphUser user, Response response) {
							// TODO Auto-generated method stub
							if(user!=null){



                                try{
                                    //json형태 데이터를 문자열로 바꿔주는 작업
                                    JSONArray ja = new JSONArray("["+user.getInnerJSONObject().toString()+"]");
                                    for(int i=0; i<ja.length(); i++){
                                        JSONObject jo = ja.getJSONObject(i);
                                        email2 = jo.getString("email");
                                        id = jo.getString("id");
                                    }
                                }catch(JSONException e){
                                    e.printStackTrace();
                                }

								String url ="http://rastro.kr/app/appFbLoginChk.php";
								//페이스북로그인 확인체크(email DB에 없으면 로그인 되지않음)
								Flt = new FacebookLoginThread(mHandler, url,email2);
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
			if(msg.what==0){//아이디나 비밀번호가 틀렸을때
				Toast.makeText(loginForm.this,getString(R.string.loginerror),Toast.LENGTH_SHORT).show();
				editEmail.setText("");//이메일 입력 초기화
				editPwd.setText(""); //비밀번호 입력 초기화
				editEmail.setFocusable(true);
				editEmail.requestFocus();
				dialog.dismiss();
				lT.interrupt();
				
			}
            if(msg.what==6){//페이스북으로 가입되지 않았을때
                new AlertDialog.Builder(loginForm.this)
                        .setMessage(getString(R.string.FaceBookFail))
                        .setCancelable(false)
                        .setNegativeButton(R.string.close,null)

                        .show();
                dialog.dismiss();
                Flt.interrupt();
            }
			if(msg.what==3){//일반 로그인 되었을때
				pref = new RbPreference(loginForm.this);
				pref.put("email", email);
				pref.put("pwd", pwd);
				
				//자동로그인 될수 있도록 어플에 저장
				Bundle bundle = msg.getData();
				Intent intent = new Intent(loginForm.this,profileForm.class);
				intent.putExtra("name",bundle.getString("name"));
				intent.putExtra("email",bundle.getString("email"));
				intent.putExtra("dob",bundle.getString("dob"));
				intent.putExtra("sex",bundle.getString("sex"));
				intent.putExtra("idx",bundle.getString("idx"));
				intent.putExtra("Ps",bundle.getString("Ps"));
                //액티비티로 넘기면서 디비에 값들도 같이 넘김
				startActivity(intent);
				finish();
				dialog.dismiss();
				lT.interrupt();
				
			}
			if(msg.what==7){//페이스북으로 로그인되었을때
				pref = new RbPreference(loginForm.this);
				Bundle bundle = msg.getData();
				pref.put("id", bundle.getString("fbcode"));//페이스북 고유ID(자동로그인 위하여 저장)
                pref.put("email",bundle.getString("email"));
				Intent intent = new Intent(loginForm.this,profileForm.class);//프로필로 이동
                intent.putExtra("fbcode",bundle.getString("fbcode"));
				intent.putExtra("name",bundle.getString("name"));
				intent.putExtra("email",bundle.getString("email"));
				intent.putExtra("dob",bundle.getString("dob"));
				intent.putExtra("sex",bundle.getString("sex"));
				intent.putExtra("idx",bundle.getString("idx"));
				intent.putExtra("Ps",bundle.getString("Ps"));
                //액티비티로 넘기면서 디비에 값들도 같이 넘김
				startActivity(intent);
				finish();
				dialog.dismiss();
				Flt.interrupt();
				
			}
			if(msg.what==5){//연결 실패
			dialog.dismiss();
			Toast.makeText(loginForm.this, R.string.noConnection, Toast.LENGTH_SHORT).show();
			}
		}
	};
	
	@Override
	public void onBackPressed() {
		// TODO Auto-generated method stub
		//Back버튼 두번 눌렀을때 종료
		bpch.onBackPressed();
	}
}
