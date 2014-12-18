package br.edu.ifpb.ifnutri.service;

import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicHeader;
import org.apache.http.protocol.HTTP;
import org.json.JSONObject;

import android.util.Log;

public class HTTPService {

	// URL to get JSON Array - br.edu.ifpb
	private static String URL = "http://192.168.1.66/NutrIF_service";

	// constructor
	public HTTPService() {
	}

	public HttpResponse sendGETRequest(String service) {

		HttpResponse response = null;

		HttpGet httpGet = new HttpGet(URL + service);

		try {

			HttpClient httpClient = new DefaultHttpClient();

			response = httpClient.execute(httpGet);

		} catch (ClientProtocolException e) {
			Log.e("HttpService ClientProtocol AsyncTaskKJson",
					"Error converting result " + e.toString());
		} catch (IOException e) {
			Log.e("HttpService AsyncTaskKJson",
					"Error converting result " + e.toString());
		}

		return response;
	}

	public HttpResponse sendJsonPostRequest(String service, JSONObject json) {

		// Response
		HttpResponse response = null;

		// Create a new HttpClient and Post Header
		HttpClient httpClient = new DefaultHttpClient();

		HttpPost httpPost = new HttpPost(URL + service);

		try {

			httpPost.setHeader("Accept", "application/json");
			httpPost.setHeader("Content-type", "application/json");

			StringEntity se = new StringEntity(json.toString(), HTTP.UTF_8);
			se.setContentEncoding(new BasicHeader(HTTP.CONTENT_TYPE,
					"application/json;charset=" + HTTP.UTF_8));

			httpPost.setEntity(se);

			response = httpClient.execute(httpPost);

		} catch (UnsupportedEncodingException e) {

			Log.i("AsyncTaskKJson", e.getMessage());

		} catch (ClientProtocolException e) {

			Log.i("AsyncTaskKJson", e.getMessage());

		} catch (IOException e) {

			Log.i("AsyncTaskKJson", e.getMessage());
		}

		return response;
	}

	public HttpResponse sendParamPostRequest(String service,
			List<NameValuePair> nameValuePairs) {

		// Response
		HttpResponse response = null;

		// Create a new HttpClient and Post Header
		HttpClient httpClient = new DefaultHttpClient();

		HttpPost httppost = new HttpPost(URL + service);

		try {
			// Add data
			httppost.setEntity(new UrlEncodedFormEntity(nameValuePairs));

			// Execute HTTP Post Request
			response = httpClient.execute(httppost);

		} catch (UnsupportedEncodingException e) {

			Log.i("AsyncTaskKJson", e.getMessage());

		} catch (ClientProtocolException e) {

			Log.i("AsyncTaskKJson", e.getMessage());

		} catch (IOException e) {

			Log.i("AsyncTaskKJson", e.getMessage());
		}

		return response;
	}
}
