package com.example.rastro;

import android.app.Activity;
import android.os.Bundle;
import android.widget.TextView;

public class ToS extends Activity{
	TextView tos,pers;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.terms_of_service_terms_of_use);
		tos = (TextView)findViewById(R.id.tos);
		tos.setText(getString(R.string.tos)+"\n 이 약관은 라스트로에서 제공하는 서비스에 적용되는 것으로 모든 사용자에 적용됩니다."
				+ " 따라서 회원가입 또는 서비스 이용 전에 이 내용을 확인하시고 동의하셔야만 서비스에 대한 이용이 가능합니다.");
	}
}
