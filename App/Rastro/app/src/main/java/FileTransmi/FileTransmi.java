package FileTransmi;

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

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;

public class FileTransmi extends Thread{
	String uri,idx,fName;
	Handler handler;
	
	int serverResponseCode = 0;
	public FileTransmi(String uri,String idx,Handler handler,String fName) {
		// TODO Auto-generated constructor stub
		this.uri = uri;
		this.fName = fName;
		this.idx = idx;
		this.handler = handler;
		
	}
	@Override
	public void run() {
		// TODO Auto-generated method stub
		super.run();
		upLoadFile(uri);
	}
	public int upLoadFile(String sourceFileUri ){
		String fileName = sourceFileUri;
		HttpURLConnection conn = null;
		String lineEnd = "\r\n";
		String twoHyphens = "--";
		DataOutputStream dos = null;
		String boundary = "*****";
		int bytesRead,byteAvailable,bufferSize;
		byte[] buffer = null;
		int maxBufferSize = 5*1024*1024;
		File sourceFile= new File(sourceFileUri);
		
		try{
			FileInputStream fileInputStream = new FileInputStream(sourceFile);
			URL url = new URL("http://rastro.kr/app/test.php");
			System.out.println(idx);
			conn = (HttpURLConnection)url.openConnection();
			conn.setDoInput(true);//InputStream으로 서버로 부터 응답을 받겠다는 옵션
			conn.setDoOutput(true);//OutputStream으로 Post데이터를 넘겨주겠다는 옵션
			conn.setUseCaches(false);//캐시를 사용하지 않겠다는 옵션
			conn.setRequestMethod("POST");//POST타입으로 설정
	        conn.setRequestProperty("Connection", "Keep-Alive");//커넥션을 재사용할수 있도록 하겠다
	        conn.setRequestProperty("ENCTYPE", "multipart/form-data");
	        conn.setRequestProperty("Content-Type", "multipart/form-data;boundary=" + boundary);
	        conn.setRequestProperty("uploadedfile", fileName);
	        System.out.println(fileName);
			dos = new DataOutputStream(conn.getOutputStream());
		
			dos.writeBytes(twoHyphens+boundary+lineEnd);
			dos.writeBytes("Content-Disposition: form-data; name=\"uploadedfile\";filename=\""
                    + fileName + "\"" + lineEnd);
			dos.writeBytes(lineEnd);
			
			byteAvailable = fileInputStream.available();//현재 읽을 수 있는 바이트 수를 얻는다.
			bufferSize = Math.min(byteAvailable, maxBufferSize);//두수중 작은쪽 반환
			 buffer = new byte[bufferSize];
	         
             // read file and write it into form...
             bytesRead = fileInputStream.read(buffer, 0, bufferSize); 
               
             while (bytesRead > 0) {
                 
               dos.write(buffer, 0, bufferSize);
               byteAvailable = fileInputStream.available();
               bufferSize = Math.min(byteAvailable, maxBufferSize);
               bytesRead = fileInputStream.read(buffer, 0, bufferSize);  
               
              }
   
             // send multipart form data necesssary after file data...
             dos.writeBytes(lineEnd);
             dos.writeBytes(twoHyphens + boundary + twoHyphens + lineEnd);
   
             // Responses from the server (code and message)
             serverResponseCode = conn.getResponseCode();
             String serverResponseMessage = conn.getResponseMessage();
             fileInputStream.close();
             dos.flush();
             dos.close();
             HttpClient httpclient = new DefaultHttpClient();
     	
     			
     			ArrayList<NameValuePair> post = new ArrayList<NameValuePair>();
     			
     			post.add(new BasicNameValuePair("idx", idx));
     			post.add(new BasicNameValuePair("fName", fName));
     			
     			System.out.println(post);
     			String result="";
     			HttpParams params = httpclient.getParams();
     			HttpConnectionParams.setConnectionTimeout(params, 5000);
     			System.out.println("연결되나요?");
     			System.out.println(url);
     			HttpPost httppost = new HttpPost("http://rastro.kr/app/test.php");
     			UrlEncodedFormEntity entityRequest = new UrlEncodedFormEntity(post,"UTF-8");
     			httppost.setEntity(entityRequest);
     			System.out.println("못받나요?");
     			HttpResponse response = httpclient.execute(httppost);
     			System.out.println("안되나요?");
     			
     			HttpEntity entityResponse = response.getEntity();
     			InputStream is = entityResponse.getContent();
    			
    			BufferedReader reader = new BufferedReader(new InputStreamReader(is,"UTF-8"),8);
    			StringBuilder sb=new StringBuilder();
    			String line = null;
    			while((line = reader.readLine())!=null){
    				sb.append(line);
    			}
    			
    			is.close();
    			result=sb.toString();
    			System.out.println(result);
    			Message msg = handler.obtainMessage();
				msg.what=2;
				handler.sendMessage(msg);
		}catch(Exception e){
            Message msg = handler.obtainMessage();
            msg.what=3;
            handler.sendMessage(msg);
		}
	 return serverResponseCode;
		
	}
}
