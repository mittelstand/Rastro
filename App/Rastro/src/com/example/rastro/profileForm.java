package com.example.rastro;

import java.io.*;
import java.util.*;

import org.apache.http.*;
import org.apache.http.client.*;
import org.apache.http.client.entity.*;
import org.apache.http.client.methods.*;
import org.apache.http.impl.client.*;
import org.apache.http.message.*;
import org.apache.http.params.*;
import org.json.*;

import Thread.*;
import android.app.*;
import android.content.*;
import android.os.*;
import android.view.*;
import android.view.View.OnClickListener;
import android.widget.*;
import android.widget.RadioGroup.OnCheckedChangeListener;

public class profileForm extends Activity{
	EditText editEmail,editName,editBirth;
	RadioGroup sexRbg;
	RadioButton rbMan,rbWoMan;
	
	String idx,result="",name,dob,sex,email;
	String url="http://rastro.kr/app/appProfile.php";
	TextView tv;
	Button logoutbtn,memberModifyBtn;
	MemberModifyThread memberModify;
	RbPreference pref;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.profileform);
		Intent intent = getIntent();
		String name=intent.getStringExtra("name");
		String email=intent.getStringExtra("email");
		String dob=intent.getStringExtra("dob");
		idx=intent.getStringExtra("idx");
		editEmail = (EditText)findViewById(R.id.editEmail);
		editName=(EditText)findViewById(R.id.editName);
		editBirth=(EditText)findViewById(R.id.editBirth);
		sexRbg = (RadioGroup)findViewById(R.id.sexRbg);
		rbMan = (RadioButton)findViewById(R.id.rbMan);
		rbWoMan = (RadioButton)findViewById(R.id.rbWoMan);
		logoutbtn = (Button)findViewById(R.id.logoutbtn);
		memberModifyBtn = (Button)findViewById(R.id.memberModify);
		editName.setText(name);
		editEmail.setText(email);
		editBirth.setText(dob);
//		editEmail.setText(pref.getValue("email", ""));
		sexRbg.setOnCheckedChangeListener(new OnCheckedChangeListener() {
			
			@Override
			public void onCheckedChanged(RadioGroup group, int checkedId) {
				// TODO Auto-generated method stub
				if(group.getId()==R.id.sexRbg){
					switch (checkedId) {
					case R.id.rbMan:
						sex = "남성";
						break;
					case R.id.rbWoMan:
						sex = "여성";
						break;
					}
				}
			}
		});
		
		logoutbtn.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				pref = new RbPreference(profileForm.this);
				pref.put("email", "");
				pref.put("pwd", "");
				pref.put("id", "");
				
				startActivity(new Intent(profileForm.this,JoinForm.class));
				finish();	
			}
		});
		
		
		
		
	memberModifyBtn.setOnClickListener(new OnClickListener() {
		@Override
		public void onClick(View v) {
			// TODO Auto-generated method stub
			
			String url = "http://rastro.kr/app/appMemberModify.php";
			memberModify = new MemberModifyThread(idx,editEmail.getText().toString(),editName.getText().toString(),editBirth.getText().toString(),sex,url,mHandler);
			memberModify.start();
			
		}
	});
	
	}
//	void profile(){
//		InputStream is = null;
//		HttpClient httpclient = new DefaultHttpClient();
//		try{
//			
//			ArrayList<NameValuePair> post = new ArrayList<NameValuePair>();
//			post.add(new BasicNameValuePair("idx", idx));
//			
//			
//			
//			
//			//파라미터를 얻어와서
//			HttpParams params = httpclient.getParams();
//			HttpConnectionParams.setConnectionTimeout(params, 10000);
//			//3초이상 연결안되면 끊어지게
//			System.out.println("연결되나요?");
//			
//			System.out.println(url);
//			HttpPost httppost = new HttpPost(url);
//			//Post 방식의 요청
//			UrlEncodedFormEntity entityRequest = new UrlEncodedFormEntity(post,"UTF-8");
//			
//			httppost.setEntity(entityRequest);
//			System.out.println("못받나요?");
//			
//			HttpResponse response = httpclient.execute(httppost);
//			System.out.println("안되나요?");
//			HttpEntity entityResponse = response.getEntity();
//			is=entityResponse.getContent();
//			
//			BufferedReader reader = new BufferedReader(new InputStreamReader(is,"UTF-8"),8);
//			StringBuilder sb=new StringBuilder();
//			String line = null;
//			while((line = reader.readLine())!=null){
//				sb.append(line);
//			}
//			
//			is.close();
//			result=sb.toString();
//			
//			
////			System.out.println(sb);
////			System.out.println("온다");
//			System.out.println("여기까지는 되네");
//			jsonParsing();
//			
//			
//		
//			
//			
//			
//		}catch (Exception e) {
//			// TODO: handle exception
//		}
//	
//	}
	
	Handler mHandler = new Handler(){
		public void handleMessage(Message msg){ 
			if(msg.what==0){
				Toast.makeText(profileForm.this, "수정이 완료 되었습니다.", Toast.LENGTH_SHORT).show();
			}
		}
	};

}
