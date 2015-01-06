package com.example.test;

import java.io.*;

import org.apache.http.*;
import org.apache.http.client.*;
import org.apache.http.client.methods.*;
import org.apache.http.impl.client.*;
import org.apache.http.params.*;
import org.json.*;

import android.os.*;

public class JsonThread extends Thread{
	Handler handler;
	
	public JsonThread(Handler handler) {
		// TODO Auto-generated constructor stub
		this.handler = handler;
		
	}
	@Override
	public void run() {
		// TODO Auto-generated method stub
		super.run();
		InputStream is =null;
		HttpClient httpclient = new DefaultHttpClient();
		
	}
	InputStream is = null;
		
		String sbb="";
		HttpClient httpclient = new DefaultHttpClient();
		try{
			HttpParams params = httpclient.getParams();
			HttpConnectionParams.setConnectionTimeout(params, 3000);
		System.out.println("클라이언트 연걸?");
		
			HttpPost httppost = new HttpPost(url);
			HttpResponse response = httpclient.execute(httppost);
			HttpEntity entituyResponse = response.getEntity();
			
			is = entituyResponse.getContent();
			BufferedReader reader = new BufferedReader(new InputStreamReader(is,"UTF-8"),8);
			StringBuilder sb = new StringBuilder();
			String line=null;
			while((line=reader.readLine())!=null){
				sb.append(line);
			}
			is.close();
			sbb = sb.toString();
			
			JSONArray ja = new JSONArray(sbb);
			System.out.println(ja);
			for(int i=0; i<ja.length();i++){
			JSONObject joObject = ja.getJSONObject(i);
			result+="이름 : "+ joObject.getString("name")+",이메일 : "+joObject.getString("email")+", 비밀번호 : "+joObject.getString("pw")+"\n";
				
			}
			Test.setText(result);
			
		}catch(Exception e){
			
		}
		
			
		
		
}

