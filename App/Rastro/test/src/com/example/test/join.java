package com.example.test;

import java.io.*;
import java.util.*;

import org.apache.http.*;
import org.apache.http.client.*;
import org.apache.http.client.entity.*;
import org.apache.http.client.methods.*;
import org.apache.http.impl.client.*;
import org.apache.http.message.*;
import org.apache.http.params.*;

import android.app.*;
import android.os.*;
import android.view.*;
import android.view.View.OnClickListener;
import android.widget.*;

public class join extends Activity{
	Button confirm;
	ProgressDialog dialog = null;
	String name,email,pw,result;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.join);
		confirm=(Button)findViewById(R.id.confirm);
		confirm.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
			if(name.equals("")||email.equals("")||pw.equals("")){
					Toast.makeText(join.this,"입력이 제대로 되지않았습니다.", Toast.LENGTH_SHORT).show();
					return;
				
			}
			
				name=((EditText)findViewById(R.id.editName)).getText().toString();
				email=((EditText)findViewById(R.id.editEmail)).getText().toString();
				pw=((EditText)findViewById(R.id.editPw)).getText().toString();
				
//				dialog=ProgressDialog.show(join.this,"loading...", null, true);
				new Thread(new Runnable(){	
					@Override
					public void run() {
						// TODO Auto-generated method stub
						Join();
					}
					
				}).start();
			}
		});
	}
	void Join(){
		InputStream is = null;
		HttpClient httpclient = new DefaultHttpClient();
		try{
			String url="http://rastro.kr/joinInsert.php";
			ArrayList<NameValuePair> post = new ArrayList<NameValuePair>();
			post.add(new BasicNameValuePair("name", name));
			post.add(new BasicNameValuePair("email", email));
			post.add(new BasicNameValuePair("pw", pw));
			System.out.println(post);
			String result;
			HttpParams params = httpclient.getParams();
			HttpConnectionParams.setConnectionTimeout(params, 3000);
			System.out.println("연결되나요?");
			
			HttpPost httppost = new HttpPost(url);
			UrlEncodedFormEntity entityRequest = new UrlEncodedFormEntity(post,"euc-kr");
			httppost.setEntity(entityRequest);
			System.out.println("못받나요?");
			
			HttpResponse response = httpclient.execute(httppost);
			System.out.println("안되나요?");
			HttpEntity entityResponse = response.getEntity();
			is=entityRequest.getContent();
			
			BufferedReader reader = new BufferedReader(new InputStreamReader(is,"euc-kr"),8);
			StringBuilder sb=new StringBuilder();
			String line = null;
			while((line = reader.readLine())!=null){
				sb.append(line);
			}
			is.close();
			result=sb.toString();
			
			System.out.println(result);
			System.out.println("온다");
			
		}catch (Exception e) {
			// TODO: handle exception
		}
			
		
	}
	
}
