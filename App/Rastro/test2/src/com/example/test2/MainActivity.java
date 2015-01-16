package com.example.test2;



import java.util.*;

import android.app.*;
import android.content.*;
import android.content.DialogInterface.OnClickListener;
import android.os.*;
import android.view.*;
import android.widget.*;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.AdapterView.OnItemLongClickListener;


public class MainActivity extends Activity {
	String[] arGeneral = {"수정","삭제"};
	AlertDialog ab;
	EditText editText1,editText2,editText3;
	ArrayList<license>  license;
	MyListAdapter adapter;
	ListView list,list1;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		 license = new ArrayList<license>();
		list  = (ListView)findViewById(R.id.listView1);
		
		 list.setOnItemLongClickListener(new OnItemLongClickListener() {
			@Override
			public boolean onItemLongClick(AdapterView<?> parent, View view,
				 final int position, long id) {
				// TODO Auto-generated method stub
				
				ArrayAdapter<String> adapter1;
				adapter1 = new ArrayAdapter<String>(MainActivity.this, android.R.layout.simple_list_item_1,arGeneral);
				
				final View innerView=getLayoutInflater().inflate(R.layout.list,null);
				list1 = (ListView)innerView.findViewById(R.id.list);
				list1.setAdapter(adapter1);
				ab =new AlertDialog.Builder(MainActivity.this)
				.setView(innerView)
				.setNegativeButton("취소", null).show();
				
				list1.setOnItemClickListener(new OnItemClickListener() {
					
					@Override
					public void onItemClick(AdapterView<?> parent, View view,
							final int position1, long id) {
						// TODO Auto-generated method stub
						
						if(arGeneral[position1].equals("수정")){
							ab.dismiss();
							final View innerView=getLayoutInflater().inflate(R.layout.add,null);
							final EditText editText1=(EditText)innerView.findViewById(R.id.editText1);
							editText1.setText(license.get(position).Pname);
							final EditText editText2=(EditText)innerView.findViewById(R.id.editText2);
							editText2.setText(license.get(position).Pinst);
							final EditText editText3=(EditText)innerView.findViewById(R.id.editText3);
							editText3.setText(license.get(position).Pbreakdown);
							new AlertDialog.Builder(MainActivity.this)
							.setTitle("수상 기록하기")
							.setView(innerView)
							
							.setPositiveButton("확인", new DialogInterface.OnClickListener() {
								
								@Override
								public void onClick(DialogInterface dialog, int which) {
									// TODO Auto-generated method stub
									System.out.println(license);
									
									license li = new license(editText1.getText().toString(), editText2.getText().toString(), editText3.getText().toString());
									license.add(li);
									adapter = new MyListAdapter(MainActivity.this, R.layout.custonlist, license);
									
									list.setAdapter(adapter);
									license.remove(position);
									list.clearChoices();
									
									adapter.notifyDataSetChanged();
								}
							})
							.setNegativeButton("취소", null).show();
						}
						if(arGeneral[position1].equals("삭제")){
							ab.dismiss();
							  new AlertDialog.Builder(MainActivity.this)
								.setTitle("삭제")
								.setMessage("삭제 하시겠습니까?")
								.setPositiveButton("확인", new OnClickListener() {
									
									@Override
									public void onClick(DialogInterface dialog, int which) {
										// TODO Auto-generated method stub
										license.remove(position);
										list.clearChoices();
										adapter.notifyDataSetChanged();
									}
								}).show();
						}
					}
				});
				return false;
			}
		});

		
	}
	public void mOnClick(View v){
		switch (v.getId()) {
		case R.id.addbtn:
			final View innerView=getLayoutInflater().inflate(R.layout.add,null);
			new AlertDialog.Builder(MainActivity.this)
			.setTitle("수상 기록하기")
			.setView(innerView)
			.setPositiveButton("확인", new DialogInterface.OnClickListener() {
				
				@Override
				public void onClick(DialogInterface dialog, int which) {
					// TODO Auto-generated method stub
					EditText editText1=(EditText)innerView.findViewById(R.id.editText1);
					EditText editText2=(EditText)innerView.findViewById(R.id.editText2);
					EditText editText3=(EditText)innerView.findViewById(R.id.editText3);
					license li = new license(editText1.getText().toString(), editText2.getText().toString(), editText3.getText().toString());
					license.add(li);
					adapter = new MyListAdapter(MainActivity.this, R.layout.custonlist, license);
					
					list.setAdapter(adapter);
					adapter.notifyDataSetChanged();
				}
			})
			.setNegativeButton("취소", null).show();
			break;
		}
	}
}
