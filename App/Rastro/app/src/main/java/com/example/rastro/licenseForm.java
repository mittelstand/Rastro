package com.example.rastro;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import Adapter.MyListAdapter;
import Adapter.license;
import Thread.prizeInsertThread;
import Thread.prizeupdate_deleteThread;

public class licenseForm extends Activity{
	AlertDialog ab;
	ArrayList<license>  license;
//	ArrayList<ArrayList<pdetail>> pdetail;
    MyListAdapter adapter;
	ArrayList<String> pdetail;
//	ExpandableAdapter adapter;
    ListView list;
//	ExpandableListView Elv;
	ListView deleteDialog;
	Intent intent;
	String idx,name,i,json;
	prizeInsertThread PIT;
	EditText PName,Pinst,Pdetails;
	prizeupdate_deleteThread PUDT;
	final static int Prize_Detail=0;
	
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
//		 pdetail = new ArrayList<String>();
//		 pdetail = new ArrayList<ArrayList<pdetail>>();
//		 Elv  = (ExpandableListView)findViewById(R.id.Elv);
        list = (ListView)findViewById(R.id.list);
		 if(json==null){
			
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
//						pdetail.add(pdetails);
//						license li = new license(pname, pinst,pdetail,idx);
                        license li = new license(pname, pinst,pdetails,idx);
						license.add(li);
//						pdetail.add(pd);
						
						
					}

                 adapter = new MyListAdapter(licenseForm.this, R.layout.customlist, license);
//					adapter = new ExpandableAdapter(licenseForm.this, license,R.layout.customlist,R.layout.customlist_child);
                 list.setAdapter(adapter);

//					 Elv.setAdapter(adapter);
			 }catch(JSONException e){
				 e.printStackTrace();
			 }

		 }



//		 list.setOnItemLongClickListener(new OnItemLongClickListener() {
//
//			@Override
//			public boolean onItemLongClick(AdapterView<?> parent, View view,
//					final int position, long id) {
//				// TODO Auto-generated method stub
//				final String[] del=getResources().getStringArray(R.array.del);
//				ArrayAdapter<String> adapter1;
//				adapter1 = new ArrayAdapter<String>(licenseForm.this, android.R.layout.simple_list_item_1,del);
//				
//				final View innerView=getLayoutInflater().inflate(R.layout.image_crop,null);
//				deleteDialog = (ListView)innerView.findViewById(R.id.photoList);
//				deleteDialog.setAdapter(adapter1);
//				ab =new AlertDialog.Builder(licenseForm.this)
//				.setView(innerView)
//				.setNegativeButton("취소", null).show();
//				deleteDialog.setOnItemClickListener(new OnItemClickListener() {
//
//					@Override
//					public void onItemClick(AdapterView<?> parent, View view,
//							int position1, long id) {
//						// TODO Auto-generated method stub
//						if(del[position1].equals("삭제")){
//							ab.dismiss();
//							  new AlertDialog.Builder(licenseForm.this)
//								.setTitle("삭제")
//								.setMessage("삭제 하시겠습니까?")
//								.setPositiveButton("확인", new OnClickListener() {
//									
//									@Override
//									public void onClick(DialogInterface dialog, int which) {
//										// TODO Auto-generated method stub
//										PUDT=new prizeupdate_deleteThread(license.get(position).Pname, license.get(position).Pinst, license.get(position).Pbreakdown, name, license.get(position).i, mHandler, idx, "del");
//										PUDT.start();
//										license.remove(position);
//										list.clearChoices();
//										adapter.notifyDataSetChanged();
//									}
//								})
//								.setNegativeButton("취소", null).show();
//						}
//						if(del[position1].equals("수정")){
//							ab.dismiss();
//							final View innerView=getLayoutInflater().inflate(R.layout.add,null);
//							final EditText PName=(EditText)innerView.findViewById(R.id.PName);
//							PName.setText(license.get(position).Pname);
//							final EditText Pinst=(EditText)innerView.findViewById(R.id.Pinst);
//							Pinst.setText(license.get(position).Pinst);
//							final EditText Pdetails=(EditText)innerView.findViewById(R.id.Pdetails);
//							Pdetails.setText(license.get(position).Pbreakdown);
//							new AlertDialog.Builder(licenseForm.this)
//							.setTitle("수상 기록하기")
//							.setView(innerView)
//							
//							.setPositiveButton("확인", new DialogInterface. OnClickListener() {
//								
//								@Override
//								public void onClick(DialogInterface dialog, int which) {
//									// TODO Auto-generated method stub
//									System.out.println(license);
//									PUDT=new prizeupdate_deleteThread(PName.getText().toString(), Pinst.getText().toString(), Pdetails.getText().toString(), name, license.get(position).i, mHandler, idx, "modify");
//									PUDT.start();
//									license li = new license(PName.getText().toString(), Pinst.getText().toString(), Pdetails.getText().toString(),i);
//									license.add(li);
//									adapter = new MyListAdapter(licenseForm.this, R.layout.customlist, license);
//									
//									list.setAdapter(adapter);
//									license.remove(position);
//									list.clearChoices();
//									
//									adapter.notifyDataSetChanged();
//								}
//							})
//							.setNegativeButton("취소", null).show();
//							
//						}
//					}
//				});
//				return false;
//			}
//		});
        list.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent = new Intent(licenseForm.this, Prizedetail.class);
                intent.putExtra("pName", license.get(position).Pname.toString());
                intent.putExtra("pinst",license.get(position).Pinst.toString());
                intent.putExtra("pd",license.get(position).Pbreakdown.toString());
                intent.putExtra("i",license.get(position).i.toString());
                intent.putExtra("idx",idx);
                intent.putExtra("name",name);
                intent.putExtra("position",position);

                startActivityForResult(intent,Prize_Detail);
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


                license li = new license(PName.getText().toString(), Pinst.getText().toString(),Pdetails.getText().toString(),i);
                license.add(li);
                adapter = new MyListAdapter(licenseForm.this, R.layout.customlist, license);
//				adapter = new ExpandableAdapter(licenseForm.this, license,R.layout.customlist,R.layout.customlist_child);
				list.setAdapter(adapter);
//				 Elv.setAdapter(adapter);
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
//		case R.id.menu_search:
//
//			break;
			
		}
		return false;
		
	}
//	@Override
//	public boolean onCreateOptionsMenu(Menu menu) {
//		// TODO Auto-generated method stub
//		getMenuInflater().inflate(R.menu.menu_min, menu);
//		SearchView searchView = (SearchView)menu.findItem(R.id.menu_search).getActionView();
//		return true;
//		
//	}

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {

        if(data ==null){
            return;
        }else {
            switch (requestCode) {
                case Prize_Detail:
                    if (resultCode == 2) {

                    } else if (resultCode == 0) {
                        String Pname = data.getStringExtra("Pname");
                        String Pinst = data.getStringExtra("Pinst");
                        String Pdetail = data.getStringExtra("Pdetail");
                        String i = data.getStringExtra("i");
                        int Position = data.getExtras().getInt("position");
                        license li = new license(Pname, Pinst, Pdetail, i);
                        license.add(li);
                        adapter = new MyListAdapter(licenseForm.this, R.layout.customlist, license);
                        list.setAdapter(adapter);
                        license.remove(Position);
                        adapter.notifyDataSetChanged();
                    } else if (resultCode == 1) {
                        int Position = data.getExtras().getInt("position");
                        license.remove(Position);
                        list.clearChoices();
                        adapter.notifyDataSetChanged();
                    }
                    break;


            }
        }
    }
}
