package utility;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

/**
 * Created by 아연이 on 2015-02-05.
 */
public class NetworkConnectionCheck {

    //    static ProgressDialog Pdialog;
    public static Context context;
    public static ProgressDialog Pdialog = null;
    public NetworkConnectionCheck(Context context,ProgressDialog dia){
        Pdialog = dia;
        this.context = context;
    }
    public static boolean isNetworkStat() {
        ConnectivityManager manager =
                (ConnectivityManager)context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo mobile = manager.getNetworkInfo(ConnectivityManager.TYPE_MOBILE);
        NetworkInfo wifi = manager.getNetworkInfo(ConnectivityManager.TYPE_WIFI);
        NetworkInfo lte_4g = manager.getNetworkInfo(ConnectivityManager.TYPE_WIMAX);
        boolean blte_4g = false;
        if(lte_4g != null)
            blte_4g = lte_4g.isConnected();
        if( mobile != null ) {
            if (mobile.isConnected() || wifi.isConnected() || blte_4g)

                return true;
        } else {
            if ( wifi.isConnected() || blte_4g )

                return true;
        }

        AlertDialog.Builder dlg = new AlertDialog.Builder(context);
        dlg.setTitle("네트워크 오류");
        dlg.setMessage("네트워크 상태를 확인해 주십시요.");

        dlg.setNegativeButton("확인", new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int whichButton) {
                dialog.dismiss();
                Pdialog.dismiss();

            }
        });
        dlg.show();
        return false;
    }

}
