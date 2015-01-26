package Adapter;

import java.util.*;

import com.example.rastro.*;

import android.content.*;
import android.view.*;
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
		TextView prizeName = (TextView)convertView.findViewById(R.id.prizeName);
		prizeName.setText(arSrc.get(position).Pname);
		TextView prizeinst = (TextView)convertView.findViewById(R.id.prizeinst);
		prizeinst.setText(arSrc.get(position).Pinst);
//		TextView prizeDetails = (TextView)convertView.findViewById(R.id.prizeDetails);
//		prizeDetails.setText(arSrc.get(position).Pbreakdown);
		TextView hidden = (TextView)convertView.findViewById(R.id.hidden);
		hidden.setText(arSrc.get(position).i);
		return convertView;
	}
	
}
