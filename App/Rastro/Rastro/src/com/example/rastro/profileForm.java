package com.example.rastro;

import Thread.*;
import android.content.*;
import android.os.*;
import android.view.*;
import android.view.View.OnClickListener;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.*;
import android.widget.RadioGroup.OnCheckedChangeListener;

import com.jeremyfeinstein.slidingmenu.lib.*;
import com.jeremyfeinstein.slidingmenu.lib.app.*;

public class profileForm extends SlidingActivity{
	EditText editEmail,editName,editBirth;
	RadioGroup sexRbg;
	RadioButton rbMan,rbWoMan;
	Intent intent;
	String idx,result="",name,dob,sex,email;
	String url="http://rastro.kr/app/appProfile.php";
	ListView menuListView;
	Button logoutbtn,memberModifyBtn;
	MemberModifyThread memberModify;
	RbPreference pref;
	ArrayAdapter<CharSequence> adapter;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.profileform);
		setBehindContentView(R.layout.profileform_menu);
		final String[] menu=getResources().getStringArray(R.array.menu);
		getSlidingMenu().setBehindOffset(200);
		getSlidingMenu().setMode(SlidingMenu.LEFT);
		getSlidingMenu().setFadeDegree(0.35f);
		intent = getIntent();
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
		adapter=ArrayAdapter.createFromResource(profileForm.this, R.array.menu, android.R.layout.simple_list_item_1);
		menuListView = (ListView)findViewById(R.id.menuListView);
		menuListView.setAdapter(adapter);
		
		memberModifyBtn = (Button)findViewById(R.id.memberModify);
		editName.setText(name);
		editEmail.setText(email);
		editBirth.setText(dob);
		sexChk();
		menuListView.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View view,
					int position, long id) {
				// TODO Auto-generated method stub
				if(menu[position].equals("로그아웃")){
					pref = new RbPreference(profileForm.this);
					pref.put("email", "");
					pref.put("pwd", "");
					pref.put("id", "");
					
					startActivity(new Intent(profileForm.this,JoinForm.class));
					finish();	
				}
				if(menu[position].equals("비밀번호 설정/변경")){
					startActivity(new Intent(profileForm.this,JoinForm.class));
					finish();
				}
			}
		});	
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
		
//		logoutbtn.setOnClickListener(new OnClickListener() {
//			@Override
//			public void onClick(View v) {
//				// TODO Auto-generated method stub
//				
//			}
//		});
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

	public void sexChk(){
		String sex=intent.getStringExtra("sex");
		
		if(sex.equals("남성")){
			rbMan.setChecked(true);
		}else if(sex.equals("여성")){
			rbWoMan.setChecked(true);
		}
	}
	Handler mHandler = new Handler(){
		public void handleMessage(Message msg){ 
			if(msg.what==0){
				Toast.makeText(profileForm.this, "수정이 완료 되었습니다.", Toast.LENGTH_SHORT).show();
			}
		}
	};

}
