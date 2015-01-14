package FileTransmi;

import java.io.*;
import java.io.ObjectOutputStream.*;
import java.net.*;
import java.security.*;
import java.util.*;

import org.apache.http.*;
import org.apache.http.client.*;
import org.apache.http.client.entity.*;
import org.apache.http.client.methods.*;
import org.apache.http.impl.client.*;
import org.apache.http.message.*;
import org.apache.http.params.*;
import org.json.*;

import android.graphics.*;
import android.os.*;

public class FileDownload extends Thread{
	String uRl1;
	Handler handler;
	public FileDownload(String url, Handler handler) {
		// TODO Auto-generated constructor stub
	this.uRl1=url;
	this.handler = handler;
	}
	@Override
	public void run() {
		// TODO Auto-generated method stub
		super.run();
		        Bitmap imgBitmap = null;
		        HttpURLConnection conn = null;
		        BufferedInputStream bis = null;
		        
		        try
		        {
		            URL url = new URL(uRl1);
		            conn = (HttpURLConnection)url.openConnection();
		            conn.connect();
		            
		            int nSize = conn.getContentLength();
		            bis = new BufferedInputStream(conn.getInputStream(), nSize);
		            imgBitmap = BitmapFactory.decodeStream(bis);
		        	Message msg = handler.obtainMessage();
					Bundle bundle = new Bundle();
					
					msg.setData(bundle);		
					msg.what=3;
					handler.sendMessage(msg);
		        }
		        catch (Exception e){
		            e.printStackTrace();
		        } finally{
		            if(bis != null) {
		                try {bis.close();} catch (IOException e) {}
		            }
		            if(conn != null ) {
		                conn.disconnect();
		            }
		        }
		        
		       
		    }
	
	
	
}
