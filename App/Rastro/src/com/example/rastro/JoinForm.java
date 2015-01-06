package com.example.rastro;

import java.util.*;
import java.util.regex.*;

import utility.*;

import com.facebook.*;
import com.facebook.model.*;

import Thread.*;
import android.app.*;
import android.content.*;
import android.os.*;
import android.text.style.*;
import android.view.*;
import android.view.View.OnClickListener;
import android.view.View.OnFocusChangeListener;
import android.widget.*;


public class JoinForm extends Activity {
	ArrayAdapter<CharSequence> adspin;
	
	Button joinBtn,fbloginBtn;
	TextView loginTv;
	String sex,name,email,pwd,dob,year,month,day;
	String emailRegex="^[a-zA-Z0-9-_]+@[a-zA-Z0-9-_]+(.[a-zA-Z0-9-_]+)*$";
	String pwdRegex = "^(?=.*[a-zA-Z])(?=.*[0-9]).{8,16}$";
	String pwdRegex2 = "^[0-9]*$";
	EditText editName,editEmail,editPwd,editYear,editMonth,editDay;
	ProgressDialog dialog = null;
	loginThread lT;
	FacebookLoginThread Flt;
	RbPreference pref;
	RadioGroup radiogroup;
	RadioButton rbMan,rbWoman;
	BackPressCloseHandler bpch;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.joinform);
		loginTv = (TextView)findViewById(R.id.login);
		joinBtn = (Button)findViewById(R.id.joinBtn);
		editEmail = (EditText)findViewById(R.id.editEmail);
		editPwd = (EditText)findViewById(R.id.editPwd);
		editName = (EditText)findViewById(R.id.editName);
		fbloginBtn = (Button)findViewById(R.id.fbBtn);
		bpch=new BackPressCloseHandler(JoinForm.this);
		
		
		//이메일 유효성검사
		editEmail.setOnFocusChangeListener(new OnFocusChangeListener() {
			@Override
			public void onFocusChange(View v, boolean hasFocus) {
				// TODO Auto-generated method stub
					if(editEmail.getText().toString().length()>0){
						if(hasFocus==false){
							Pattern pattern = Pattern.compile(emailRegex);
							Matcher matcher = pattern.matcher(editEmail.getText().toString());
							if(matcher.matches()){
								
							}else{
								
								Toast.makeText(JoinForm.this, getString(R.string.emailRegex), Toast.LENGTH_SHORT).show();
								
								editEmail.setText("");
								
							}
								
						}
				}
			}
		});
		//비밀번호 영문/숫자조합8~16자리
		editPwd.setOnFocusChangeListener(new OnFocusChangeListener() {
			
			@Override
			public void onFocusChange(View v, boolean hasFocus) {
				// TODO Auto-generated method stub
				if(editPwd.getText().toString().length()>0){
					if(hasFocus==false){
						Pattern pattern = Pattern.compile(pwdRegex);
						Matcher matcher = pattern.matcher(editPwd.getText().toString());
						if(matcher.matches()){
							
						}else{
							
							Toast.makeText(JoinForm.this, getString(R.string.pwdRegex), Toast.LENGTH_SHORT).show();
							
							editPwd.setText("");
							
						}
							
					}
			}
			}
		});
		//로그인화면으로 전환
		loginTv.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				
				
				startActivity(new Intent(JoinForm.this,loginForm.class));
				finish();
			}
		});
		//회원가입(DB에 데이터 저장)
		joinBtn.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
			
				 
				 name = editName.getText().toString();
				 email = editEmail.getText().toString();
				 pwd = editPwd.getText().toString();
				 if(name.length()<=0){
					Toast.makeText(JoinForm.this, getString(R.string.NameInputLimit),Toast.LENGTH_SHORT).show();
					return;
				 }
				 if(email.length()<=0){
						Toast.makeText(JoinForm.this, getString(R.string.EmailInputLimit),Toast.LENGTH_SHORT).show();
						return;
				}
				

				dialog = ProgressDialog.show(JoinForm.this, "", "Loading.....");
				 String  URL = "http://rastro.kr/app/appJoinInsert.php";
//				 String URL = "http://rastro.kr/mailTest.php";
				 
				 joinThread jT = new joinThread(name,email,pwd,mHandler,URL);
				 jT.start();
			}
		});
		fbloginBtn.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				FacebookLogin();
			}
		});
		
	}//결과값 표시?
	Handler mHandler = new Handler(){
		public void handleMessage(Message msg){
			if(msg.what==0){
				editName.setText("");
				editEmail.setText("");
				editPwd.setText("");
				
				editName.setFocusable(true);
				editName.requestFocus();
				dialog.dismiss();
				new AlertDialog.Builder(JoinForm.this)
				.setMessage(getString(R.string.joinchk))
				.setCancelable(false)
				.setNegativeButton("닫기", new DialogInterface.OnClickListener() {
					
					@Override
					public void onClick(DialogInterface dialog, int which) {
						// TODO Auto-generated method stub
						startActivity(new Intent(JoinForm.this,loginForm.class));
							
					}
				})
			.show();
				
			}
			if(msg.what==1){
				editEmail.setText("");
				dialog.dismiss();
				new AlertDialog.Builder(JoinForm.this)
				.setMessage(getString(R.string.Emailoverlap))
				.setCancelable(false)
				.setNegativeButton("닫기", null)
				.show();
			}
			if(msg.what==2){
				dialog.dismiss();
			}
		
			if(msg.what==4){
				
				dialog.dismiss();
				new AlertDialog.Builder(JoinForm.this)
				.setMessage("페이스북으로 가입이 되었습니다.")
				.setCancelable(false)
				.setNegativeButton("닫기", null)
				.show();
			}
			if(msg.what==5){
				dialog.dismiss();
				Toast.makeText(JoinForm.this, "연결 실패", Toast.LENGTH_SHORT).show();
			}
			if(msg.what==6){
				dialog.dismiss();
				new AlertDialog.Builder(JoinForm.this)
				.setMessage("페이스북으로 이미 가입하였습니다.")
				.setCancelable(false)
				.setNegativeButton("닫기", null)
				.show();
			}
	
		}
	};
	
	public void FacebookLogin(){
		Session.openActiveSession(JoinForm.this,true, new Session.StatusCallback() {	
			@Override
			public void call(Session session, SessionState state, Exception exception) {
				// TODO Auto-generated method stub
				if(session.isOpened()){
					

					if(!session.getPermissions().contains("email")) {

					String[] PERMISSION_ARRAY_READ = {"email","user_birthday"};

					List<String> PERMISSION_LIST=Arrays.asList(PERMISSION_ARRAY_READ);

					session.requestNewReadPermissions(

					new Session.NewPermissionsRequest(JoinForm.this, PERMISSION_LIST));

					}
					Request.executeMeRequestAsync(session, new Request.GraphUserCallback() {
						
						@Override
						public void onCompleted(GraphUser user, Response response) {
							// TODO Auto-generated method stub
							if(user!=null){
								String email2 = user.getProperty("email").toString();
								String name2 = user.getName().toString();
								String id = user.getId().toString();
								String url ="http://rastro.kr/app/appFbInsert.php";
								String[] a=null;
								String dob;
								if(user.getBirthday()!=null){
								a = user.getBirthday().split("/");
								dob = a[2]+"-"+a[0]+"-"+a[1];
								}else{
								dob = "";
								}
								dialog = ProgressDialog.show(JoinForm.this, "", "Loading.....");
								FacebookJoinThread Flt = new FacebookJoinThread(name2, email2, dob,mHandler, url,id);
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
		Session.getActiveSession().onActivityResult(JoinForm.this, requestCode, resultCode, data);
	}
	@Override
	public void onBackPressed() {
		// TODO Auto-generated method stub
		super.onBackPressed();
		bpch.onBackPressed();
	}

}
