package com.example.test2;

import java.util.*;

import android.content.*;
import android.view.*;
import android.view.View.OnClickListener;
import android.widget.*;

public class MyListAdapter extends BaseAdapter{
	Context context;
	LayoutInflater  Inflater;
	ArrayList<license> arSrc;
	int layout;
	
	public MyListAdapter(Context context,int alayout,ArrayList<license> aarSrc) {
		// TODO Auto-generated constructor stub
		this.context = context;
		Inflater = (LayoutInflater)context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
		arSrc = aarSrc;
		layout = alayout;
	}
	
	@Override
	public int getCount() {
		// TODO Auto-generated method stub
		return arSrc.size();
	}
	@Override
	public String getItem(int position) {
		// TODO Auto-generated method stub
		return arSrc.get(position).Pname;
	}
	@Override
	public long getItemId(int position) {
		// TODO Auto-generated method stub
		return position;
	}
	@Override
	public View getView(final int position, View convertView, ViewGroup parent) {
		// TODO Auto-generated method stub
		if(convertView==null){
			convertView = Inflater.inflate(layout, parent,false);
		}
		TextView tv1 = (TextView)convertView.findViewById(R.id.textView2);
		tv1.setText(arSrc.get(position).Pname);
		TextView tv2 = (TextView)convertView.findViewById(R.id.textView4);
		tv2.setText(arSrc.get(position).Pinst);
		TextView tv3 = (TextView)convertView.findViewById(R.id.textView6);
		tv3.setText(arSrc.get(position).Pbreakdown);
		
		return convertView;
	}
	
}
