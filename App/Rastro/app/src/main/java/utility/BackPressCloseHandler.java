package utility;

import android.app.*;
import android.widget.*;

import com.example.rastro.R;

public class BackPressCloseHandler {

	 private long backKeyPressedTime = 0;
	    private Toast toast;
	 
	    private Activity activity;
	 
	    public BackPressCloseHandler(Activity context) {
	        this.activity = context;
	    }
	 
	    public void onBackPressed() {
	        if (System.currentTimeMillis() > backKeyPressedTime + 2000) {
	            backKeyPressedTime = System.currentTimeMillis();
	            showGuide();
	            return;
	        }
	        if (System.currentTimeMillis() <= backKeyPressedTime + 2000) {
	            activity.finish();
	            toast.cancel();
	        }
	    }
	    public void showGuide() {
//            String cont = "\'"+R.string.Back+"\'"+R.string.BackButton;
	        toast = Toast.makeText(activity,R.string.BackButton,Toast.LENGTH_SHORT);
	        toast.show();
	    }
}
