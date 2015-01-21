package com.example.rastro;

import java.io.*;
import java.net.*;

import utility.*;
import FileTransmi.*;
import Thread.*;
import android.app.*;
import android.content.*;
import android.database.*;
import android.graphics.*;
import android.graphics.Bitmap.CompressFormat;
import android.net.*;
import android.os.*;
import android.provider.*;
import android.view.*;
import android.view.View.OnClickListener;
import android.widget.*;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.RadioGroup.OnCheckedChangeListener;

import com.jeremyfeinstein.slidingmenu.lib.*;
import com.jeremyfeinstein.slidingmenu.lib.app.*;

public class profileForm extends SlidingActivity{
	
	Bitmap bitmap;
	Uri contentUri;
	prizeSelect ps;
	Bundle bundle;
	ActionBar ab;
	
	private static final int REQUEST_IMAGE_CAPTURE = 1;
	private static final int REQUEST_IMAGE_ALBUM = 2;
	private static final int REQUEST_IMAGE_CROP = 3,REQUEST_IMAGE_CROP1=4;
	AlertDialog mDialog;
	EditText editEmail,editName,editBirth;
	RadioGroup sexRbg;
	RadioButton rbMan,rbWoMan;
	Intent intent;
	String idx,result="",name,dob,sex,email,pname,pinst,pfidx,pidx,Pdetails;
	String url="http://rastro.kr/app/appProfile.php",url1,mCurrentPhotoPath;
	ListView menuListView;
	Button logoutbtn,memberModifyBtn;
	MemberModifyThread memberModify;
	RbPreference pref;
	ArrayAdapter<CharSequence> adapter;
	ImageView Image;
	ProgressDialog dialog = null;
	BackPressCloseHandler bpch;
	@Override
	public void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.profileform);
		setBehindContentView(R.layout.profileform_menu);
		final String[] menu=getResources().getStringArray(R.array.menu);
		bpch=new BackPressCloseHandler(profileForm.this); 
		pref = new RbPreference(profileForm.this);
		
		getSlidingMenu().setTouchModeAbove(SlidingMenu.TOUCHMODE_NONE);
		getSlidingMenu().setBehindOffset(200);
		getSlidingMenu().setMode(SlidingMenu.LEFT);
		getSlidingMenu().setFadeDegree(0.35f);
		getSlidingMenu().toggle(false);
		intent = getIntent();
		String name=intent.getStringExtra("name");
		String email=intent.getStringExtra("email");
		String dob=intent.getStringExtra("dob");
		if(intent.getStringExtra("Ps").equals("")){
			//프로필사진
		}else{
			String[] tmUrl = intent.getStringExtra("Ps").split("/");
			url1 ="http://"+ tmUrl[2]+"/"+tmUrl[4]+"/"+tmUrl[5];

			new Thread(new Runnable() {
				@Override
				public void run() {
					// TODO Auto-generated method stub
					
					bitmap = getImageFromURL(url1);
					  runOnUiThread(new Runnable() {
	                      public void run() {
	        				Image.setImageBitmap(bitmap);
	                      }
	                  });    
				}
			}).start();	
		}
		idx=intent.getStringExtra("idx");//idx값
		editEmail = (EditText)findViewById(R.id.editEmail);
		editName=(EditText)findViewById(R.id.editName);
		editBirth=(EditText)findViewById(R.id.editBirth);
		sexRbg = (RadioGroup)findViewById(R.id.sexRbg);
		rbMan = (RadioButton)findViewById(R.id.rbMan);
		rbWoMan = (RadioButton)findViewById(R.id.rbWoMan);
		adapter=ArrayAdapter.createFromResource(profileForm.this, R.array.menu, android.R.layout.simple_list_item_1);
		menuListView = (ListView)findViewById(R.id.menuListView);
		menuListView.setAdapter(adapter);
		Image =(ImageView)findViewById(R.id.photo);
		memberModifyBtn = (Button)findViewById(R.id.memberModify);
		editName.setText(name);
		editEmail.setText(email);
		editBirth.setText(dob);
		sexChk();//성별체크
		
		menuListView.setOnItemClickListener(new OnItemClickListener() {
			//슬라이드메뉴리스트
			@Override
			public void onItemClick(AdapterView<?> parent, View view,
					int position, long id) {
				// TODO Auto-generated method stub
				if(menu[position].equals("로그아웃")){
					new AlertDialog.Builder(profileForm.this)
					.setTitle("로그아웃")
					.setMessage("로그아웃을 하시겠습니까?")
					.setPositiveButton("확인", new DialogInterface.OnClickListener() {
						
						public void onClick(DialogInterface dialog, int which) {
							// TODO Auto-generated method stub
							pref.put("email", "");
							pref.put("pwd", "");
							pref.put("id", "");
							pref.put("img", "");
							startActivity(new Intent(profileForm.this,JoinForm.class));
							finish();
						}
					})
					.setNegativeButton("취소",null).show();
				}
				if(menu[position].equals("비밀번호 설정/변경")){
					intent=new Intent(profileForm.this,PwChangeForm.class);
					intent.putExtra("idx", idx);
					startActivity(intent);
				}
				if(menu[position].equals("수상 기록")){
					dialog = ProgressDialog.show(profileForm.this, "", "Loading.....");
					ps = new prizeSelect(idx, mHandler);
					ps.start();
				}
				if(menu[position].equals("설정")){
					intent = new Intent(profileForm.this,SettingsActivity.class);
					startActivity(intent);
				}
			}
		});	
		sexRbg.setOnCheckedChangeListener(new OnCheckedChangeListener() {
			//성별선택
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
	memberModifyBtn.setOnClickListener(new OnClickListener() {
		//수정
		@Override
		public void onClick(View v) {
			// TODO Auto-generated method stub
			
			String url = "http://rastro.kr/app/appMemberModify.php";
			dialog = ProgressDialog.show(profileForm.this, "", "Loading.....");
			memberModify = new MemberModifyThread(idx,editEmail.getText().toString(),editName.getText().toString(),editBirth.getText().toString(),sex,url,mHandler);
			memberModify.start();
			
		}
	});
	Image.setOnClickListener(new OnClickListener() {
		
		@Override
		public void onClick(View v) {
			// TODO Auto-generated method stub
			mDialog =createDialog();
			mDialog.show();
			
			
			
		}
	});
	}
	Handler mHandler = new Handler(){
		public void handleMessage(Message msg){ 
			if(msg.what==0){
				dialog.dismiss();
				Toast.makeText(profileForm.this, "수정이 완료 되었습니다.", Toast.LENGTH_SHORT).show();
			}
			if(msg.what==1){
				dialog.dismiss();
				Bundle bundle = msg.getData();
				
				intent=new Intent(profileForm.this,licenseForm.class);
				intent.putExtra("idx", idx);
				intent.putExtra("json", bundle.getString("json"));
				intent.putExtra("name", editName.getText().toString());
				startActivity(intent);
				ps.interrupt();
			}
			if(msg.what==2){
				dialog.dismiss();
				
			}
		}
		
	};
	public void menuButton(View v){
		switch (v.getId()) {
		case R.id.menuButton:
			getSlidingMenu().setBehindOffset(200);
			getSlidingMenu().setMode(SlidingMenu.LEFT);
			getSlidingMenu().setFadeDegree(0.35f);
			getSlidingMenu().toggle(false);
			break;

		default:
			break;
		}
	}
	  public static Bitmap getImageFromURL(String imageURL){
	        Bitmap imgBitmap = null;
	        HttpURLConnection conn = null;
	        BufferedInputStream bis = null;
	        
	        try
	        {
	            URL url = new URL(imageURL);
	            conn = (HttpURLConnection)url.openConnection();
//	            conn.connect();
	            
	            int nSize = conn.getContentLength();
	            bis = new BufferedInputStream(conn.getInputStream(), nSize);
	            imgBitmap = BitmapFactory.decodeStream(bis);
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
	        
	        return imgBitmap;
	    }
	public void sexChk(){
		String sex=intent.getStringExtra("sex");
		
		if(sex.equals("남성")){
			rbMan.setChecked(true);
		}else if(sex.equals("여성")){
			rbWoMan.setChecked(true);
		}
	}

	//프로필사진 
	public AlertDialog createDialog(){
		ArrayAdapter<CharSequence> adapter;
		final String[] photo=getResources().getStringArray(R.array.photo);
		View innerView=getLayoutInflater().inflate(R.layout.image_crop,null);
		adapter=ArrayAdapter.createFromResource(profileForm.this, R.array.photo, android.R.layout.simple_list_item_1);
		ListView photoList=(ListView)innerView.findViewById(R.id.photoList);
		photoList.setAdapter(adapter);
		photoList.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> parent, View view,
					int position, long id) {
		//		 TODO Auto-generated method stub
				if(photo[position].equals("사진 촬영")){
					Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
			        // Crop된 이미지를 저장할 파일의 경로를 생성
			        contentUri = createSaveCropFile();
			        intent.putExtra(android.provider.MediaStore.EXTRA_OUTPUT, contentUri);
			        startActivityForResult(intent, REQUEST_IMAGE_CAPTURE);
				    setDismiss(mDialog);
				}
				
				if(photo[position].equals("앨범에서 가져오기")){
					Intent intent = new Intent(Intent.ACTION_PICK, android.provider.MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
					intent.setType(android.provider.MediaStore.Images.Media.CONTENT_TYPE);
					startActivityForResult(intent, REQUEST_IMAGE_ALBUM);		
					
					setDismiss(mDialog);
				}
				
			}
		});
		AlertDialog.Builder ab = new AlertDialog.Builder(profileForm.this);
		ab.setView(innerView);
		return ab.create();
	}
	 private void setDismiss(AlertDialog dialog){
	        if(dialog!=null&&dialog.isShowing()){
	            dialog.dismiss();
	        }
	   }
	
	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		if(resultCode != RESULT_OK){
			return;
		}
		switch(requestCode){
		case REQUEST_IMAGE_ALBUM:
			contentUri = data.getData();
			System.out.println(contentUri.getPath().toString());
			Intent intent1  = new Intent("com.android.camera.action.CROP");
			intent1.setDataAndType(contentUri, "image/*");
			intent1.putExtra("aspectX", 1);
			intent1.putExtra("aspectY", 1);
			intent1.putExtra("outputX", 300);
			intent1.putExtra("outputY", 300);
			intent1.putExtra("return-data", true);
//			intent1.putExtra("output", contentUri);
			startActivityForResult(intent1, REQUEST_IMAGE_CROP1);
			
			break;
		case REQUEST_IMAGE_CAPTURE:
			Intent intent  = new Intent("com.android.camera.action.CROP");
			intent.setDataAndType(contentUri, "image/*");
			System.out.println(contentUri);
			intent.putExtra("aspectX", 1);
			intent.putExtra("aspectY", 1);
			intent.putExtra("outputX", 300);
			intent.putExtra("outputY", 300);
			
			intent.putExtra("output", contentUri);
			startActivityForResult(intent, REQUEST_IMAGE_CROP);
			break;
		case REQUEST_IMAGE_CROP:
			String full_path = contentUri.getPath();
			System.out.println(full_path);
			String photo_path = full_path.substring(29,full_path.length());
			Bitmap photo = BitmapFactory.decodeFile(full_path);
			Image.setImageBitmap(photo);
			dialog = ProgressDialog.show(profileForm.this, "", "Loading.....");
			FileTransmi Ft = new FileTransmi(full_path,idx,mHandler,photo_path);
			Ft.start();
			break;
		case  REQUEST_IMAGE_CROP1:	
		Bundle extras = data.getExtras();
		System.out.println(extras);
		String filePath=  Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES).getAbsolutePath() + "/tmp_"+String.valueOf(System.currentTimeMillis())+".jpg";
		if(extras !=null){
			Bitmap photo1 = (Bitmap)extras.get("data");
			String photo_path1 = filePath.substring(29,filePath.length());
			System.out.println(photo1);
			storeCropImage(photo1, filePath);
			Image.setImageBitmap(photo1);
			System.out.println(filePath);
			dialog = ProgressDialog.show(profileForm.this, "", "Loading.....");
			FileTransmi Ft1 = new FileTransmi(filePath,idx,mHandler,photo_path1);
			Ft1.start();
		}
		
		
		
		}
		

	
	}
	/*선택된 uri의 사진 path를 가져온다
	uri가 null 경우 마지막에 저장된 사진을 가져온다
	*/
	private File getImageFile(Uri uri) {
		String[] projection = {MediaStore.Images.Media.DATA};
		if(uri ==null){
			uri = MediaStore.Images.Media.EXTERNAL_CONTENT_URI;
			
		}
		 Cursor mCursor = getContentResolver().query(uri, projection, null, null, 
	                MediaStore.Images.Media.DATE_MODIFIED + " desc");
		if(mCursor ==null||mCursor.getCount()<1){// 커서에 기록이 없습니다.
			return null;
		}
		int column_index =mCursor.getColumnIndexOrThrow(MediaStore.Images.Media.DATA);
		mCursor.moveToFirst();
		String path = mCursor.getString(column_index);
		if(mCursor!=null){
			mCursor.close();
			mCursor = null;
		}
		return new File(path);
	}

	private void storeCropImage(Bitmap bitmap, String filePath) {
		File copyFile = new File(filePath);
		BufferedOutputStream out = null;
		
		try {
		copyFile.createNewFile();
		out = new BufferedOutputStream(new FileOutputStream(copyFile));
		bitmap.compress(CompressFormat.JPEG, 100, out);
		out.flush();
		out.close();
		} catch (Exception e) {         
		e.printStackTrace();
		}
		}
	private Uri createSaveCropFile(){
		Uri uri;
		String url= "tmp_"+String.valueOf(System.currentTimeMillis())+".jpg";
		File storageDir = Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES);
		
		uri = Uri.fromFile(new File(storageDir,url));
		return uri;
		
	}
	@Override
	public void onBackPressed() {
		// TODO Auto-generated method stub
		
		bpch.onBackPressed();
	}
}
