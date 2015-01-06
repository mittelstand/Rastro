package Thread;

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

import com.example.rastro.*;

import android.os.*;

public class FacebookLoginThread extends Thread{
	String url,id;
	Handler handler;
	RbPreference pref;
	public FacebookLoginThread(Handler handler,String url,String id) {
		// TODO Auto-generated constructor stub
		this.handler =handler;
		this.id=id;
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
			
			post.add(new BasicNameValuePair("id", id));
			
			
			
			
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
				msg.what=0;
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
					System.out.println(bundle.getString("name"));
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
