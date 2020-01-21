/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package averageteamdprs;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.io.Reader;
import java.net.URL;
import java.net.URLConnection;
import java.nio.charset.Charset;
import java.text.DecimalFormat;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 *
 * @author dvpie
 */
public class AverageTeamDPRS {

    public static String code = "VG6oKsnz6E2EheeIFFkZwHjcAT66vwpttZTXWmXyPOSMyjmRyrA9Q5I8cUeiZTeJ";
    public static String base = "https://www.thebluealliance.com/api/v3/";
    
    public static void main(String[] args) throws IOException, JSONException {
        //First Get Team Events
        DecimalFormat df = new DecimalFormat("#.##");
        int teams[] = {
            1018,1024,135,1501,1529,1555,1646,1720,1741,1747,2171,2197,234,2867,2909,292,3147,3176,
            3180,3487,3494,3559,3865,3936,3940,3947,4008,4272,447,4485,45,4580,461,4926,4982,5010,5188,5402,
            5484,6451,6498,6721,6956,71,7198,7454,7457,7477,7502,7617,7657,7695,8103,8116,8232,829,868
            
        };
        double ops[] = new double[teams.length];
        for(int k = 0; k < teams.length; k++) {
            int team = teams[k];
        String append = "team/frc" + team + "/events";
        String url = base + append;
        double sum = 0;
        JSONArray teamEvents = readJsonAFromURL(url);
        //Now for every event in the array get the event key;
        String[] keys = new String[teamEvents.length()];
        for(int i = 0; i < teamEvents.length(); i++) {
            keys[i] = getEventKey(teamEvents.getJSONObject(i));
        }
        //Get OPRS for each event
        int length = keys.length;
        for(String key : keys) {
            append = "event/" + key + "/oprs";
            url = base + append;
            try {
                JSONObject oprs = readJsonFromURL(url).getJSONObject("dprs");
                double opr = oprs.getDouble("frc" + team);
                sum += opr;
            } catch(JSONException e) {
                length -= 1;
            }
        }
        sum = sum / length;
        ops[k] = sum;
        }
        JSONObject AverageOPRS = new JSONObject();
        for(int i = 0; i < teams.length; i++) {
            AverageOPRS.put("frc" + teams[i], df.format(ops[i]));
        }
        System.out.println("");
        System.out.println(AverageOPRS.toString());
        PrintWriter writer = new PrintWriter("//var//www//html//FRC Fantasy//databases//AverageDPRS.json", "UTF-8");
        writer.println(AverageOPRS.toString());
        writer.close();
        
        
    }
    
    public static JSONObject readJsonFromURL(String url) throws IOException, JSONException {
        URLConnection connection = new URL(url).openConnection();
        connection.setRequestProperty("X-TBA-Auth-Key",code);
        connection.setRequestProperty("accept","application/json");
        InputStream is = connection.getInputStream();
        try {
            BufferedReader rd = new BufferedReader(new InputStreamReader(is, Charset.forName("UTF-8")));
            String jsonText = readAll(rd);
            JSONObject json = new JSONObject(jsonText);
            return json;
        } finally {
            is.close();
        }
    }
    public static JSONArray readJsonAFromURL(String url) throws IOException, JSONException {
        URLConnection connection = new URL(url).openConnection();
        connection.setRequestProperty("X-TBA-Auth-Key",code);
        connection.setRequestProperty("accept","application/json");
        InputStream is = connection.getInputStream();
        try {
            BufferedReader rd = new BufferedReader(new InputStreamReader(is, Charset.forName("UTF-8")));
            String jsonText = readAll(rd);
            JSONArray json = new JSONArray(jsonText);
            return json;
        } finally {
            is.close();
        }
    }
    private static String readAll(Reader rd) throws IOException {
        StringBuilder sb = new StringBuilder();
        int cp;
        while((cp = rd.read()) != -1) {
            sb.append((char) cp);
        }
        return sb.toString();
    }
    private static String getEventKey(JSONObject event) throws JSONException{
        return event.getString("key");
    }

}
