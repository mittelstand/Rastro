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

import android.os.*;

public class PwChangeThread extends Thread{
	String idx,url,pwd;
	Handler handler;
	public PwChangeThread(String idx, String pwd, String url,Handler handler) {
		// TODO Auto-generated constructor stub
		this.idx = idx;
		this.url = url;
		this.pwd = pwd;
		this.handler =handler;
	}
	@Override
	public void run() {
		// TODO Auto-generated method stub
		super.run();
		InputStream is = null;
		HttpClient httpclient = new DefaultHttpClient();
		try{
			
			ArrayList<NameValuePair> post = new ArrayList<NameValuePair>();
			
			post.add(new BasicNameValuePair("pwd", pwd));
			post.add(new BasicNameValuePair("idx", idx));

			System.out.println(post);
			String result="";
			//파라미터를 얻어와서
			HttpParams params = httpclient.getParams();
			HttpConnectionParams.setConnectionTimeout(params, 3000);
			//3초 이상 연결이 안되면 끊어 지게
			System.out.println("연결되나요?");
			System.out.println(url);
			
			HttpPost httppost = new HttpPost(url);
			//Post 방식의 요청
			UrlEncodedFormEntity entityRequest = new UrlEncodedFormEntity(post,"UTF-8");
			//다국어 처리
			httppost.setEntity(entityRequest);
			
			System.out.println("못받나요?");
			HttpResponse response = httpclient.execute(httppost);
			System.out.println("안되나요?");
			//실행하고 결과 response로 받아오기
			HttpEntity entityResponse = response.getEntity();
			//엔티티 얻어오기
			is=entityResponse.getContent();
			//응답된 데이터를 읽을수 있는 입력스트림 넘어옴
			BufferedReader reader = new BufferedReader(new InputStreamReader(is,"euc-kr"),8);
			// 인코딩 처리 버퍼드리더 얻어옴
			StringBuilder sb=new StringBuilder();
			String line = null;
			while((line = reader.readLine())!=null){
				sb.append(line);
				// 한라인씩 읽어서 스트링 버퍼에 담음
			}
			
			is.close();
			result=sb.toString();
			
			
			
			System.out.println("온다");
			System.out.println("여기까지는 되네");
			System.out.println(result);
			if(result.indexOf("success")!=-1){
				Message msg = handler.obtainMessage();
				msg.what=0;
				handler.sendMessage(msg);
				
			
			}
		}catch(Exception e){
			Message msg = handler.obtainMessage();
			msg.what=5;
			handler.sendMessage(msg);
		}
	}
}
