package com.example.rastro;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.widget.TextView;

import com.facebook.Request;
import com.facebook.Response;
import com.facebook.Session;
import com.facebook.SessionState;
import com.facebook.model.GraphUser;

import java.util.Arrays;
import java.util.List;


public class fbLogin extends Activity{
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.fblogin);
		
		Session.openActiveSession(fbLogin.this,true, new Session.StatusCallback() {	
			@Override
			public void call(Session session, SessionState state, Exception exception) {
				// TODO Auto-generated method stub
				if(session.isOpened()){
					

					if(!session.getPermissions().contains("email")) {

					String[] PERMISSION_ARRAY_READ = {"email","user_birthday"};

					List<String> PERMISSION_LIST=Arrays.asList(PERMISSION_ARRAY_READ);

					session.requestNewReadPermissions(

					new Session.NewPermissionsRequest(fbLogin.this, PERMISSION_LIST));

					}
					Request.executeMeRequestAsync(session, new Request.GraphUserCallback() {
						
						@Override
						public void onCompleted(GraphUser user, Response response) {
							// TODO Auto-generated method stub
							if(user!=null){
								String[] a=null;
								TextView tv = (TextView)findViewById(R.id.fblogin);
								if(user.getBirthday()!=null){
								a = user.getBirthday().split("/");
								
								}else{}
								
								
							
								
								
							}
						}
					});
				}
			}
		});
		
	}
	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		// TODO Auto-generated method stub
		super.onActivityResult(requestCode, resultCode, data);
		Session.getActiveSession().onActivityResult(fbLogin.this, requestCode, resultCode, data);
	}
}
