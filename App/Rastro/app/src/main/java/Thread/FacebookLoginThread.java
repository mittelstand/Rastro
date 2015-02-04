package Thread;

import android.os.Bundle;
import android.os.Handler;
import android.os.Message;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.params.HttpConnectionParams;
import org.apache.http.params.HttpParams;
import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;

import utility.RbPreference;

public class FacebookLoginThread extends Thread{
	String url,email;
	Handler handler;
	RbPreference pref;
	public FacebookLoginThread(Handler handler,String url,String email) {
		// TODO Auto-generated constructor stub
		this.handler =handler;
		this.email=email;
		this.url = url;
	}
	@Override
	public void run() {
		// TODO Auto-generated method stub
		super.run();
		InputStream is = null;
		HttpClient httpclient = new DefaultHttpClient();
		try{
			
			ArrayList<NameValuePair> post = new ArrayList<NameValuePair>();
			
			post.add(new BasicNameValuePair("email", email));
			
			
			
			
			System.out.println(post);
			String result="";
			HttpParams params = httpclient.getParams();
			HttpConnectionParams.setConnectionTimeout(params, 5000);
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
			
			BufferedReader reader = new BufferedReader(new InputStreamReader(is,"UTF-8"),8);
			StringBuilder sb=new StringBuilder();
			String line = null;
			while((line = reader.readLine())!=null){
				sb.append(line);
			}
			
			is.close();
			result=sb.toString();
			
			
			
			System.out.println("온다");
			System.out.println("여기까지는 되네");
			System.out.println(result);
			if(result.indexOf("fail")!=-1){
					
				Message msg = handler.obtainMessage();
				msg.what=6;
				handler.sendMessage(msg);
				
			}else{
				
				Bundle bundle = new Bundle();
				JSONArray ja = new JSONArray(result);
				for(int i=0; i<ja.length(); i++){
					JSONObject jo = ja.getJSONObject(i);

					bundle.putString("name",jo.getString("name"));
					bundle.putString("dob",jo.getString("dob"));
					bundle.putString("sex",jo.getString("sex"));
					bundle.putString("email",jo.getString("email"));
					bundle.putString("idx", jo.getString("idx"));
					bundle.putString("Ps", jo.getString("Ps"));
                    bundle.putString("fbcode",jo.getString("fbcode"));

					System.out.println(bundle.getString("Ps"));
				}
				Message msg = handler.obtainMessage();

				msg.setData(bundle);
				msg.what=7;
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
