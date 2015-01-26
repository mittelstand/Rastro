package com.example.rastro;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.View.OnFocusChangeListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

import Thread.PwChangeThread;
import utility.RbPreference;

public class PwChangeForm extends Activity{
	Button pwchangeBtn;
	EditText editPwd1,editPwd2,noweditPwd;
	String pwdRegex = "^(?=.*[a-zA-Z])(?=.*[0-9]).{8,16}$",url,idx,pwd;
	PwChangeThread pct;
	Intent intent;
	ProgressDialog dialog = null;
	
	RbPreference pref;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.fbpwchangeform);
		pref = new RbPreference(PwChangeForm.this);
		intent=getIntent();
		idx=intent.getStringExtra("idx");
		getActionBar().setTitle("비밀번호 설정");
		getActionBar().setDisplayHomeAsUpEnabled(true);
		getActionBar().setHomeButtonEnabled(true);
		
		
		
//		if(pref.getValue("id", "")==""){
//			setContentView(R.layout.pwchangeform);
//			pwchangeBtn =(Button)findViewById(R.id.pwchangeBtn);
//			editPwd1 =(EditText)findViewById(R.id.editPwd1);
//			noweditPwd = (EditText)findViewById(R.id.noweditPwd);
//			editPwd2 =(EditText)findViewById(R.id.editPwd2);
//				
//		}else{
		
			pwchangeBtn =(Button)findViewById(R.id.pwchangeBtn);
			
			editPwd1 =(EditText)findViewById(R.id.editPwd1);
			editPwd2 =(EditText)findViewById(R.id.editPwd2);
				
//		}
		
		
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
				//일반로그인시
				
					if(editPwd1.getText().toString().length()<=0 || editPwd2.getText().toString().length()<=0){
						Toast.makeText(PwChangeForm.this, getString(R.string.pwchangeLimit), Toast.LENGTH_SHORT).show();	
					}else{
						
						if(editPwd1.getText().toString().equals(editPwd2.getText().toString())){
								dialog = ProgressDialog.show(PwChangeForm.this, "", "Loading.....");
								url = "http://rastro.kr/app/appPwChange.php";
								pct=new PwChangeThread(idx,editPwd1.getText().toString(),url,mHandler,"일반");
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
	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		// TODO Auto-generated method stub
		
		switch (item.getItemId()) {
		case android.R.id.home:
			finish();
			break;

		default:
			break;
		}
		return true;
	}
}
