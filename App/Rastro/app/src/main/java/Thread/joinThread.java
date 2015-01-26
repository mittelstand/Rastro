package Thread;
import java.io.*;
import java.util.*;

import junit.framework.*;

import org.apache.http.*;
import org.apache.http.client.*;
import org.apache.http.client.entity.*;
import org.apache.http.client.methods.*;
import org.apache.http.impl.client.*;
import org.apache.http.message.*;
import org.apache.http.params.*;
import org.json.*;

import android.os.*;
	
public class joinThread extends Thread{
	
	String dob,name,email,pwd,sex,url;
	
	Handler handler;
	
	public joinThread(String name,String email,String pwd,Handler handler, String URL) {
		// TODO Auto-generated constructor stub
		this.name = name;
		this.email = email;
		this.pwd = pwd;
		this.handler = handler;
		
		this.url = URL;
	}
	@Override
	public void run() {
		// TODO Auto-generated method stub
		super.run();
		InputStream is = null;
		HttpClient httpclient = new DefaultHttpClient();
		try{
			
			ArrayList<NameValuePair> post = new ArrayList<NameValuePair>();
			post.add(new BasicNameValuePair("name", name));
			post.add(new BasicNameValuePair("email", email));
			post.add(new BasicNameValuePair("pwd", pwd));
			
			
			
			System.out.println(post);
			String result="";
			HttpParams params = httpclient.getParams();
			HttpConnectionParams.setConnectionTimeout(params, 3000);
			System.out.println("연결되나요?");
			System.out.println(url);
			HttpPost httppost = new HttpPost(url);
			UrlEncodedFormEntity entityRequest = new UrlEncodedFormEntity(post,"UTF-8");
			httppost.setEntity(entityRequest);
			System.out.println("못받나요?");
			
			HttpResponse response = httpclient.execute(httppost);
			System.out.println("안되나요?");
			HttpEntity entityResponse = response.getEntity();
			is=entityResponse.getContent();
			
			BufferedReader reader = new BufferedReader(new InputStreamReader(is,"euc-kr"),8);
			StringBuilder sb=new StringBuilder();
			String line = null;
			while((line = reader.readLine())!=null){
				sb.append(line);
			}
			
			is.close();
			result=sb.toString();
			
			
			System.out.println(sb);
			System.out.println("온다");
			System.out.println("여기까지는 되네");
			System.out.println(result);
			if(result.indexOf("fail")!=-1){
				Message msg = handler.obtainMessage();
				msg.what=1;
				handler.sendMessage(msg);
				
			}else if(result.indexOf("success")!=-1){
				Message msg = handler.obtainMessage();
				msg.what=0;
				handler.sendMessage(msg);
			}
		}catch (Exception e) {
			// TODO: handle exception
			Message msg = handler.obtainMessage();
			msg.what=5;
			handler.sendMessage(msg);
		}
	}
}
