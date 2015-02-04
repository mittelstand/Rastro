//회원가입 화면(일반 가입/페이스북으로 가입)
package com.example.rastro;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.View.OnFocusChangeListener;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
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
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import Thread.FacebookJoinThread;
import Thread.joinThread;
import utility.BackPressCloseHandler;
import utility.RbPreference;

public class JoinForm extends Activity {
	ArrayAdapter<CharSequence> adspin;
	TextView loginTv,clause1;
	String sex,name,email,pwd,dob,year,month,day;
	String emailRegex="^[a-zA-Z0-9-_]+@[a-zA-Z0-9-_]+(.[a-zA-Z0-9-_]+)*$",pwdRegex = "^(?=.*[a-zA-Z])(?=.*[0-9]).{8,16}$";
	EditText editName,editEmail,editPwd;
	ProgressDialog dialog = null;
	RbPreference pref;
	RadioGroup radiogroup;
	RadioButton rbMan,rbWoman;

	BackPressCloseHandler bpch;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.joinform);
		loginTv = (TextView)findViewById(R.id.login);
		editEmail = (EditText)findViewById(R.id.editEmail);
		editPwd = (EditText)findViewById(R.id.editPwd);
		editName = (EditText)findViewById(R.id.editName);
		clause1 =(TextView)findViewById(R.id.clause1);//이용약관
		bpch=new BackPressCloseHandler(JoinForm.this);
		
		
		//이메일 유효성검사
		editEmail.setOnFocusChangeListener(new OnFocusChangeListener() {
			@Override
			public void onFocusChange(View v, boolean hasFocus) {
				// TODO Auto-generated method stub
					if(editEmail.getText().toString().length()>0){
						if(hasFocus==false){
							Pattern pattern = Pattern.compile(emailRegex);//정규식
							Matcher matcher = pattern.matcher(editEmail.getText().toString());
                            //이메일 형식 검사
							if(matcher.matches()){	
							}else{
								Toast.makeText(JoinForm.this, getString(R.string.emailRegex), Toast.LENGTH_SHORT).show();
								editEmail.setText("");
							}	
						}
				}
			}
		});
		//비밀번호 영문/숫자조합8~16자리 검사
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
		//로그인 화면으로 이동
		loginTv.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				startActivity(new Intent(JoinForm.this,loginForm.class));
				finish();
			}
		});
		//이용약관으로 이동(임시)
		clause1.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				startActivity(new Intent(JoinForm.this,ToS.class));
			}
		});	
	}
	
	public void joinform(View v){
		switch (v.getId()) {
		case R.id.joinBtn://회원가입버튼
			 name = editName.getText().toString();
			 email = editEmail.getText().toString();
			 pwd = editPwd.getText().toString();
			 if(name.length()<=0){//이름 입력확인
				Toast.makeText(JoinForm.this, getString(R.string.NameInputLimit),Toast.LENGTH_SHORT).show();
				return;
			 }
			 if(email.length()<=0){//이메일 입력확인
				Toast.makeText(JoinForm.this, getString(R.string.EmailInputLimit),Toast.LENGTH_SHORT).show();
				return;
			}
			if(pwd.length()<=0){//비밀번호 입력확인
				Toast.makeText(JoinForm.this, getString(R.string.pwchangeLimit), Toast.LENGTH_SHORT).show();
				return;
			}
			dialog = ProgressDialog.show(JoinForm.this, "", "Loading.....");//로딩창
			 String  URL = "http://rastro.kr/app/appJoinInsert.php";//주소
			 joinThread jT = new joinThread(name,email,pwd,mHandler,URL);//회원가입쓰레드 
			 jT.start();
			break;
		case R.id.fbBtn:
			FacebookLogin();//페이스북 로그인연동
			break;
		}
	}
	
	
	Handler mHandler = new Handler(){
		public void handleMessage(Message msg){
			//회원가입이 정상적으로 되었을때
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
				.setNegativeButton(R.string.close, new DialogInterface.OnClickListener() {
					@Override
					public void onClick(DialogInterface dialog, int which) {
						// TODO Auto-generated method stub
						startActivity(new Intent(JoinForm.this,loginForm.class));
					}
				})
			.show();
				
			}
			if(msg.what==1){//이메일이 중복 일때 
				editEmail.setText("");//이메일입력값 초기화
                editPwd.setText("");
                editEmail.requestFocus();
				dialog.dismiss();
				new AlertDialog.Builder(JoinForm.this)
				.setMessage(getString(R.string.Emailoverlap))
				.setCancelable(false)
				.setNegativeButton(R.string.close, null)
				.show();
			}
			
		
			if(msg.what==4){//페이스북으로 가입 되었을때 	
				dialog.dismiss();
				new AlertDialog.Builder(JoinForm.this)
				.setMessage(getString(R.string.Facebookjoin))
				.setCancelable(false)
				.setNegativeButton(R.string.close, null)
				.show();
			}
			if(msg.what==5){//연결 실패
				dialog.dismiss();
				Toast.makeText(JoinForm.this, getString(R.string.noConnection), Toast.LENGTH_SHORT).show();
			}
			if(msg.what==6){//페이스북으로 이미 가입 되었을대
				dialog.dismiss();
				new AlertDialog.Builder(JoinForm.this)
				.setMessage(getString(R.string.Fbalreadyjoin))
				.setCancelable(false)
				.setNegativeButton(R.string.close, null)
				.show();
			}
	
		}
	};
    public void FacebookLogin() {//페이스북 로그인 연동 메소드
        Session.openActiveSession(JoinForm.this,true,new Session.StatusCallback() {
            @Override
            public void call(Session session, SessionState state, Exception exception) {
                // TODO Auto-generated method stub
                if (session.isOpened()) {
                    if (!session.getPermissions().contains("email")) {//페이스정보중에서 이메일 찾는부분
                        String[] PERMISSION_ARRAY_READ = {"email","user_birthday"};//이메일/생년월일
                        List<String> PERMISSION_LIST = Arrays.asList(PERMISSION_ARRAY_READ);
                        session.requestNewReadPermissions(
                                new Session.NewPermissionsRequest(JoinForm.this, PERMISSION_LIST));
                    }
                    Request.executeMeRequestAsync(session, new Request.GraphUserCallback() {
                        @Override
                        public void onCompleted(GraphUser user, Response response) {
                            // TODO Auto-generated method stub
                            if (user != null) {
                                String email2=null,id=null,name2=null;


                                try{
                                    //json형태 데이터를 문자열로 바꿔주는 작업
                                    JSONArray ja = new JSONArray("["+user.getInnerJSONObject().toString()+"]");
                                    for(int i=0; i<ja.length(); i++){
                                        JSONObject jo = ja.getJSONObject(i);
                                        email2 = jo.getString("email");
                                        id = jo.getString("id");
                                        name2 = jo.getString("name");




                                    }
                                    String[] a = null;
                                String dob;
                                if (user.getBirthday() != null) {
                                    a = user.getBirthday().split("/");
                                    dob = a[2] + "-" + a[0] + "-" + a[1];
                                } else {
                                    dob = "";
                                }

                                }catch(JSONException e){
                                    e.printStackTrace();
                                }


//                                String name2 = user.getName().toString();
//                                String id = user.getId().toString();
                                String url = "http://rastro.kr/app/appFbInsert.php";//페이스북에서 가지고 온 정보를 DB에 저장주소
//                                //yyyy/mm/dd --> split 이용하여 yyyy-mm-dd 바꾸는 작업
//                                String[] a = null;
//                                String dob;
//                                if (user.getBirthday() != null) {
//                                    a = user.getBirthday().split("/");
//                                    dob = a[2] + "-" + a[0] + "-" + a[1];
//                                } else {
//                                    dob = "";
//                                }
								dialog = ProgressDialog.show(JoinForm.this, "", "Loading.....");//로딩창
								FacebookJoinThread Flt = new FacebookJoinThread(name2, email2, dob,mHandler, url,id);//페이스북가입쓰레드
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
		//back키 두번 눌렀을때 종료 
		bpch.onBackPressed();
	}
	
}
