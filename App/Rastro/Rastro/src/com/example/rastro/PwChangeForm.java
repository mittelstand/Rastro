package com.example.rastro;

import java.util.regex.*;

import utility.*;
import Thread.*;
import android.app.*;
import android.content.*;
import android.os.*;
import android.view.*;
import android.view.View.OnClickListener;
import android.view.View.OnFocusChangeListener;
import android.widget.*;

public class PwChangeForm extends Activity{
	Button pwchangeBtn;
	EditText editPwd1,editPwd2;
	String pwdRegex = "^(?=.*[a-zA-Z])(?=.*[0-9]).{8,16}$",url,idx,pwd;
	PwChangeThread pct;
	Intent intent;
	ProgressDialog dialog = null;
	RbPreference pref;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.pwchangeform);
		pwchangeBtn =(Button)findViewById(R.id.pwchangeBtn);
		editPwd1 =(EditText)findViewById(R.id.editPwd1);
		editPwd2 =(EditText)findViewById(R.id.editPwd2);
		intent=getIntent();
		idx=intent.getStringExtra("idx");
		
		//비밀번호 영문/숫자조합8~16자리
		editPwd1.setOnFocusChangeListener(new OnFocusChangeListener() {
			@Override
			public void onFocusChange(View v, boolean hasFocus) {
				// TODO Auto-generated method stub
				pwd = editPwd1.getText().toString();
				
				if(editPwd1.getText().toString().length()>0){
					if(hasFocus==false){
						Pattern pattern = Pattern.compile(pwdRegex);
						Matcher matcher = pattern.matcher(editPwd1.getText().toString());
						if(matcher.matches()){	
						}else{
							Toast.makeText(PwChangeForm.this, getString(R.string.pwdRegex), Toast.LENGTH_SHORT).show();
							editPwd1.setText("");
						}		
					}
			}
			}
		});
		pwchangeBtn.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				
				if(editPwd1.getText().toString().length()<=0 || editPwd2.getText().toString().length()<=0){
					Toast.makeText(PwChangeForm.this, getString(R.string.pwchangeLimit), Toast.LENGTH_SHORT).show();	
				}else{
					
					if(editPwd1.getText().toString().equals(editPwd2.getText().toString())){
							dialog = ProgressDialog.show(PwChangeForm.this, "", "Loading.....");
							url = "http://rastro.kr/app/appPwChange.php";
							pct=new PwChangeThread(idx,editPwd1.getText().toString(),url,mHandler);
							pct.start();
					}else{
						Toast.makeText(PwChangeForm.this, getString(R.string.pwNosame), Toast.LENGTH_SHORT).show();
					}
				}
			}
		});
	}
	
	Handler mHandler = new Handler(){
		public void handleMessage(Message msg){ 
			if(msg.what==0){
				pref = new RbPreference(PwChangeForm.this);
				pref.put("pwd", pwd);
				dialog.dismiss();
				Toast.makeText(PwChangeForm.this, "수정이 완료 되었습니다.", Toast.LENGTH_SHORT).show();
				pct.interrupt();
				finish();
			}
			if(msg.what==5){
				dialog.dismiss();
				Toast.makeText(PwChangeForm.this, "연결 실패", Toast.LENGTH_SHORT).show();
			}
		}
	};
}
