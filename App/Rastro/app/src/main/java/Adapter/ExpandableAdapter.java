//package Adapter;
//
//import android.content.Context;
//import android.view.LayoutInflater;
//import android.view.View;
//import android.view.ViewGroup;
//import android.widget.BaseExpandableListAdapter;
//import android.widget.TextView;
//
//import com.example.rastro.R;
//
//import java.util.ArrayList;
//
//public class ExpandableAdapter extends BaseExpandableListAdapter{
//	Context context;
//	ArrayList<license> arSrc;
//	LayoutInflater  Inflater;
//	int glayout,clayout;
//	public ExpandableAdapter(Context context,ArrayList<license> arSrc,int layout,int clayout){
//		this.context = context;
//		Inflater = (LayoutInflater)context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
//		glayout = layout;
//		this.clayout = clayout;
//		this.arSrc = arSrc;
//
//	}
//
//	@Override
//	public int getGroupCount() {
//		// TODO Auto-generated method stub
//		return arSrc.size();
//	}
//
//	@Override
//	public int getChildrenCount(int groupPosition) {
//		// TODO Auto-generated method stub
//		return 1;
//
//	}
//
//	@Override
//	public Object getGroup(int groupPosition) {
//		// TODO Auto-generated method stub
//		return arSrc.get(groupPosition);
//	}
//
//	@Override
//	public Object getChild(int groupPosition, int childPosition) {
//		// TODO Auto-generated method stub
//		return arSrc.get(groupPosition).pdetail.get(childPosition);
//	}
//
//	@Override
//	public long getGroupId(int groupPosition) {
//		// TODO Auto-generated method stub
//		return groupPosition;
//	}
//
//	@Override
//	public long getChildId(int groupPosition, int childPosition) {
//		// TODO Auto-generated method stub
//		return childPosition;
//	}
//
//	@Override
//	public boolean hasStableIds() {
//		// TODO Auto-generated method stub
//		return false;
//	}
//
//	@Override
//	public View getGroupView(int groupPosition, boolean isExpanded,
//			View convertView, ViewGroup parent) {
//			View cv;
//			if(convertView==null){
//
//				convertView=Inflater.inflate(glayout, null);
//			}
//			TextView prizeName = (TextView)convertView.findViewById(R.id.prizeName);
//			prizeName.setText(arSrc.get(groupPosition).Pname);
//			TextView prizeinst = (TextView)convertView.findViewById(R.id.prizeinst);
//			prizeinst.setText(arSrc.get(groupPosition).Pinst);
////			TextView prizeDetails = (TextView)convertView.findViewById(R.id.prizeDetails);
////			prizeDetails.setText(arSrc.get(position).Pbreakdown);
//			TextView hidden = (TextView)convertView.findViewById(R.id.hidden);
//			hidden.setText(arSrc.get(groupPosition).i);
//		// TODO Auto-generated method stub
//		return convertView;
//	}
//
//	@Override
//	public View getChildView(int groupPosition, int childPosition,
//			boolean isLastChild, View convertView, ViewGroup parent) {
//		// TODO Auto-generated method stub
//		if(convertView==null){
//
//			convertView=Inflater.inflate(clayout, null);
//
//			}
//		TextView Pdetails = (TextView)convertView.findViewById(R.id.Pdetails);
//		Pdetails.setText(arSrc.get(groupPosition).pdetail.get(childPosition));
//		return convertView;
//	}
//
//	@Override
//	public boolean isChildSelectable(int groupPosition, int childPosition) {
//		// TODO Auto-generated method stub
//		return false;
//	}
//
//}
