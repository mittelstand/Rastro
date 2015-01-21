package com.example.rastro;

import java.util.*;

import org.json.*;

import Adapter.*;
import Thread.*;
import android.app.*;
import android.content.*;
import android.content.DialogInterface.OnClickListener;
import android.os.*;
import android.view.*;
import android.widget.*;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.AdapterView.OnItemLongClickListener;

public class licenseForm extends Activity{
	AlertDialog ab;
	ArrayList<license>  license;
	MyListAdapter adapter;
	ListView list,deleteDialog;
	Intent intent;
	String idx,name,i,json;
	prizeInsertThread PIT;
	EditText PName,Pinst,Pdetails;
	prizeupdate_deleteThread PUDT;
	
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.licenselist);
		intent = getIntent();
		idx = intent.getStringExtra("idx");
		name = intent.getStringExtra("name");
		json=intent.getStringExtra("json").trim();
		getActionBar().setTitle("수상기록");
		getActionBar().setDisplayHomeAsUpEnabled(true);
		getActionBar().setHomeButtonEnabled(true);
		 license = new ArrayList<license>();
		 list  = (ListView)findViewById(R.id.listView1);
		 if(json==null){
			 System.out.println("1111");
		 }else{
			 System.out.println("2222");
			 try{
				 System.out.println(json);
				 JSONArray ja = new JSONArray(json);
					for(int i=0; i<ja.length(); i++){
						JSONObject jo = ja.getJSONObject(i);
						String pname = jo.getString("pname");
						String idx = jo.getString("idx");
						String pinst = jo.getString("pinstitution");
						String pdetails = jo.getString("pdetail");
						System.out.println(idx);
						license li = new license(pname, pinst, pdetails,idx);
						license.add(li);
						
						
					} 
					
					 adapter = new MyListAdapter(licenseForm.this, R.layout.customlist, license);
					 list.setAdapter(adapter);
			 }catch(JSONException e){
				 e.printStackTrace();
			 }
			
		 }
		 list.setOnItemLongClickListener(new OnItemLongClickListener() {

			@Override
			public boolean onItemLongClick(AdapterView<?> parent, View view,
					final int position, long id) {
				// TODO Auto-generated method stub
				final String[] del=getResources().getStringArray(R.array.del);
				ArrayAdapter<String> adapter1;
				adapter1 = new ArrayAdapter<String>(licenseForm.this, android.R.layout.simple_list_item_1,del);
				
				final View innerView=getLayoutInflater().inflate(R.layout.image_crop,null);
				deleteDialog = (ListView)innerView.findViewById(R.id.photoList);
				deleteDialog.setAdapter(adapter1);
				ab =new AlertDialog.Builder(licenseForm.this)
				.setView(innerView)
				.setNegativeButton("취소", null).show();
				deleteDialog.setOnItemClickListener(new OnItemClickListener() {

					@Override
					public void onItemClick(AdapterView<?> parent, View view,
							int position1, long id) {
						// TODO Auto-generated method stub
						if(del[position1].equals("삭제")){
							ab.dismiss();
							  new AlertDialog.Builder(licenseForm.this)
								.setTitle("삭제")
								.setMessage("삭제 하시겠습니까?")
								.setPositiveButton("확인", new OnClickListener() {
									
									@Override
									public void onClick(DialogInterface dialog, int which) {
										// TODO Auto-generated method stub
										PUDT=new prizeupdate_deleteThread(license.get(position).Pname, license.get(position).Pinst, license.get(position).Pbreakdown, name, license.get(position).i, mHandler, idx, "del");
										PUDT.start();
										license.remove(position);
										list.clearChoices();
										adapter.notifyDataSetChanged();
									}
								})
								.setNegativeButton("취소", null).show();
						}
						if(del[position1].equals("수정")){
							ab.dismiss();
							final View innerView=getLayoutInflater().inflate(R.layout.add,null);
							final EditText PName=(EditText)innerView.findViewById(R.id.PName);
							PName.setText(license.get(position).Pname);
							final EditText Pinst=(EditText)innerView.findViewById(R.id.Pinst);
							Pinst.setText(license.get(position).Pinst);
							final EditText Pdetails=(EditText)innerView.findViewById(R.id.Pdetails);
							Pdetails.setText(license.get(position).Pbreakdown);
							new AlertDialog.Builder(licenseForm.this)
							.setTitle("수상 기록하기")
							.setView(innerView)
							
							.setPositiveButton("확인", new DialogInterface. OnClickListener() {
								
								@Override
								public void onClick(DialogInterface dialog, int which) {
									// TODO Auto-generated method stub
									System.out.println(license);
									PUDT=new prizeupdate_deleteThread(PName.getText().toString(), Pinst.getText().toString(), Pdetails.getText().toString(), name, license.get(position).i, mHandler, idx, "modify");
									PUDT.start();
									license li = new license(PName.getText().toString(), Pinst.getText().toString(), Pdetails.getText().toString(),i);
									license.add(li);
									adapter = new MyListAdapter(licenseForm.this, R.layout.customlist, license);
									
									list.setAdapter(adapter);
									license.remove(position);
									list.clearChoices();
									
									adapter.notifyDataSetChanged();
								}
							})
							.setNegativeButton("취소", null).show();
							
						}
					}
				});
				return false;
			}
		});
	}
	public void licenselist(View v){
		switch (v.getId()) {
		case R.id.addBtn:
			final View innerView=getLayoutInflater().inflate(R.layout.add,null);
			new AlertDialog.Builder(licenseForm.this)
			.setTitle("수상 기록하기")
			.setView(innerView)
			.setPositiveButton("확인", new DialogInterface.OnClickListener() {
				
				@Override
				public void onClick(DialogInterface dialog, int which) {
					// TODO Auto-generated method stub
					PName=(EditText)innerView.findViewById(R.id.PName);
					Pinst=(EditText)innerView.findViewById(R.id.Pinst);
					Pdetails=(EditText)innerView.findViewById(R.id.Pdetails);
					PIT = new prizeInsertThread(PName.getText().toString(),Pinst.getText().toString(),Pdetails.getText().toString(),name,idx,mHandler);
					PIT.start();
					
					
				}
			})
			.setNegativeButton("취소", null).show();
			break;

		default:
			break;
		}
	}
	Handler mHandler = new Handler(){
		public void handleMessage(Message msg){ 
			if(msg.what==1){
				Bundle bundle = msg.getData();
				i= bundle.getString("i");
				
				license li = new license(PName.getText().toString(), Pinst.getText().toString(), Pdetails.getText().toString(),i);
				license.add(li);
				adapter = new MyListAdapter(licenseForm.this, R.layout.customlist, license);
				list.setAdapter(adapter);
				adapter.notifyDataSetChanged();
			}
			if(msg.what==2){
				Toast.makeText(licenseForm.this,"삭제 되었습니다.", Toast.LENGTH_SHORT).show();
			}
			if(msg.what==3){
				Toast.makeText(licenseForm.this, "수정 되었습니다.", Toast.LENGTH_SHORT).show();
			}
			
		}
		
	};
	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		// TODO Auto-generated method stub
		
		switch (item.getItemId()) {
		case android.R.id.home:
			finish();
			break;

		default:
			break;
		}
		return true;
	}
		
}
