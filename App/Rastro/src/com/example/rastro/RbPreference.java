package com.example.rastro;

import android.app.*;
import android.content.*;

public class RbPreference {
	private final String PREF_NAME = "com.example.rastro";
	Context mContext;
	public RbPreference(Context c) {
		// TODO Auto-generated constructor stub
		mContext = c;
	}
	public void put(String key, String value){
		SharedPreferences pref = mContext.getSharedPreferences(PREF_NAME, Activity.MODE_PRIVATE);
		SharedPreferences.Editor editor = pref.edit();
		editor.putString(key, value);
		editor.commit();
	}
	public String getValue(String key,String dftValue){
		SharedPreferences pref = mContext.getSharedPreferences(PREF_NAME, Activity.MODE_PRIVATE);
		try{
			return pref.getString(key, dftValue);
			
		}catch(Exception e){
			return dftValue;
		}
		
	}
}
