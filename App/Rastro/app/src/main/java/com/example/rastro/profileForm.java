//프로필 화면(임시페이지)

package com.example.rastro;

import android.app.ActionBar;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.Bitmap.CompressFormat;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.os.Handler;
import android.os.Message;
import android.provider.MediaStore;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.RadioGroup.OnCheckedChangeListener;
import android.widget.Toast;

import com.jeremyfeinstein.slidingmenu.lib.SlidingMenu;
import com.jeremyfeinstein.slidingmenu.lib.app.SlidingActivity;

import java.io.BufferedInputStream;
import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.URL;

import FileTransmi.FileTransmi;
import Thread.MemberModifyThread;
import Thread.prizeSelect;
import utility.BackPressCloseHandler;
import utility.RbPreference;

public class profileForm extends SlidingActivity{
	
	Bitmap bitmap,bt;
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
    String fbcode;
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
        Image =(ImageView)findViewById(R.id.photo);
		intent = getIntent();
		String name=intent.getStringExtra("name");
		String email=intent.getStringExtra("email");
		String dob=intent.getStringExtra("dob");
        fbcode = intent.getStringExtra("fbcode");
		if(intent.getStringExtra("Ps").equals("")){
			//프로필사진(DB에 있는 저장경로 들고와서 이미지뷰에 넣기?
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
		adapter=ArrayAdapter.createFromResource(profileForm.this, R.array.menu, android.R.layout.simple_list_item_1);//슬라이드메뉴 정보
		menuListView = (ListView)findViewById(R.id.menuListView);
		menuListView.setAdapter(adapter);

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
                //슬라이드메뉴 클릭시

				// TODO Auto-generated method stub
				if(position==3){//로그아웃 경우
					new AlertDialog.Builder(profileForm.this)//다이얼로그
					.setTitle(R.string.logout)
					.setMessage(R.string.logoutCheck)
					.setPositiveButton(R.string.Ok, new DialogInterface.OnClickListener() {
						
						public void onClick(DialogInterface dialog, int which) {
							// TODO Auto-generated method stub
                            //프리퍼런스 초기화(화면 이동간 데이터 손실을 방지하기위하여 사용되는 자료형)
							pref.put("email", "");
							pref.put("pwd", "");
							pref.put("id", "");
							pref.put("img", "");
							startActivity(new Intent(profileForm.this,JoinForm.class));
							finish();
						}
					})
					.setNegativeButton(R.string.close,null).show();
				}
				if(position==0){//비밀번호 설정/변경 일 경우
					intent=new Intent(profileForm.this,PwChangeForm.class);
					intent.putExtra("idx", idx);//화면이동하면서 idx값도 같이 이동
					startActivity(intent);
				}
				if(position==1){//수상 기록 일 경우
					dialog = ProgressDialog.show(profileForm.this, "", "Loading.....");
					ps = new prizeSelect(idx, mHandler);// 수상기록 정보 쓰레드(DB값 들고 오는)
					ps.start();
				}
				if(position==2){//설정
					intent = new Intent(profileForm.this,SettingsActivity.class);
					startActivity(intent);//설정 화면으로 이동
				}
			}
		});	
		sexRbg.setOnCheckedChangeListener(new OnCheckedChangeListener() {
			//성별선택
			@Override
			public void onCheckedChanged(RadioGroup group, int checkedId) {//성별 선택
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
			//수정 버튼
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
            //프로필사진
		}
	});
	}

    @Override
    protected void onStart() {
        super.onStart();

		getSlidingMenu().setTouchModeAbove(SlidingMenu.TOUCHMODE_NONE);
		getSlidingMenu().setBehindOffset(200);
		getSlidingMenu().setMode(SlidingMenu.LEFT);
		getSlidingMenu().setFadeDegree(0.35f);
		getSlidingMenu().toggle(false);
    }

    Handler mHandler = new Handler(){
		public void handleMessage(Message msg){ 
			if(msg.what==0){ //수정이 되었을때(DB값 변경)
				dialog.dismiss();
				Toast.makeText(profileForm.this, R.string.ModifyCompletion, Toast.LENGTH_SHORT).show();
			}
			if(msg.what==1){//수상 기록
				dialog.dismiss();
				Bundle bundle = msg.getData();
				intent=new Intent(profileForm.this,licenseForm.class);//수상 기록 화면으로 이동
				intent.putExtra("idx", idx);
				intent.putExtra("json", bundle.getString("json"));
				intent.putExtra("name", editName.getText().toString());
				startActivity(intent);
				ps.interrupt();
			}
			if(msg.what==2){//
				dialog.dismiss();
				Toast.makeText(profileForm.this,R.string.Registration,Toast.LENGTH_SHORT).show();
			}
		}
		
	};
	public void menuButton(View v){
        //메뉴버튼(액션바부분 버튼)
		switch (v.getId()) {
		case R.id.menuButton: //슬라이드 이동
			getSlidingMenu().setBehindOffset(200);
			getSlidingMenu().setMode(SlidingMenu.LEFT);
			getSlidingMenu().setFadeDegree(0.35f);
			getSlidingMenu().toggle(false);
			break;

		default:
			break;
		}
	}
	  public static Bitmap getImageFromURL(String imageURL){//프로필 DB에 있는 저장경로 가지고 이미지뷰에 이미지 넣는 메소드
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
	public void sexChk(){//라디오버튼에 표시
		String sex=intent.getStringExtra("sex");
		
		if(sex.equals("남성")){
			rbMan.setChecked(true);
		}else if(sex.equals("여성")){
			rbWoMan.setChecked(true);
		}
	}

	//프로필사진(이미지뷰에 표시하고 서버에 이미지 저장)
	public AlertDialog createDialog(){//사진 촬영/앨범에서 가져오기/페이스북
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
				if(position==1){//카메라
					Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
			        contentUri = createSaveCropFile();
                    // Crop된 이미지를 저장할 파일의 경로를 생성
			        intent.putExtra(android.provider.MediaStore.EXTRA_OUTPUT, contentUri);
			        startActivityForResult(intent, REQUEST_IMAGE_CAPTURE);
				    setDismiss(mDialog);
				}
				
				if(position==0){//앨범에서 가져오기
					Intent intent = new Intent(Intent.ACTION_PICK, android.provider.MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
					intent.setType(android.provider.MediaStore.Images.Media.CONTENT_TYPE);
					startActivityForResult(intent, REQUEST_IMAGE_ALBUM);		
					
					setDismiss(mDialog);
				}
				if(position==2){//페이스북에서 가져오기
                    setDismiss(mDialog);

                    new Thread(new Runnable() {
                        @Override
                        public void run() {
                            // TODO Auto-generated method stub



                            bt =  getImageFromURL("https://graph.facebook.com/"+fbcode+"/picture?type=large");
                            runOnUiThread(new Runnable() {
                                public void run() {
                                    Image.setScaleType(ImageView.ScaleType.FIT_CENTER);
                                            Image.setImageBitmap(bt);

                                }
                            });
                        }
                    }).start();


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
		case REQUEST_IMAGE_ALBUM://앨범 일 경우
			contentUri = data.getData();//경로
			System.out.println(contentUri.getPath().toString());
			Intent intent1  = new Intent("com.android.camera.action.CROP");//이미지캡 화면으로 넘기기(크기조절)
			intent1.setDataAndType(contentUri, "image/*");//파일연결?
			intent1.putExtra("aspectX", 1);//최소x값
			intent1.putExtra("aspectY", 1);//최소y값
			intent1.putExtra("outputX", 300);//고정값?
			intent1.putExtra("outputY", 300);//고정값?
			intent1.putExtra("return-data", true);//
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
			
			intent.putExtra("output", contentUri);//캡 했는거 삭제
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
		//Back버튼 두번 눌렀을때 종료
		bpch.onBackPressed();
	}
}
