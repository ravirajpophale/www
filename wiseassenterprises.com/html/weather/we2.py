import urllib, json
import os
import time, datetime
__author__ = 'Mayur Kulkarni <mayurkulkarni012@gmail.com>'


def get_json(loc):
	
    #url = 'http://api.waqi.info/feed/geo:18.536428;73.805453/?token=9d43420bc698329eedd8eb12f0bf98e66426ca98'#pashan
	url = "http://api.waqi.info/feed/geo:" + str(loc["lat"]) + ";" + str(loc["lon"]) + "/?token=9d43420bc698329eedd8eb12f0bf98e66426ca98"
	response = urllib.urlopen(url)
	data = json.loads(response.read())
	return data

def append_headers(file_handle):
	file_handle.write('timestamp, aqi, co, h, no2, o3, pm10, pm25, t')
	file_handle.write('\n')

def current_timestamp():
	return datetime.datetime.fromtimestamp(time.time()) \
							.strftime('%Y-%m-%d %H:%M:%S')

station_info = {
	"bhosari": {
		"lat": 18.642103,
        "lon": 73.849083,
	},
	"shivajinagar": {
		"lat": 18.529603,
        "lon": 73.849586,
	},
	"hadapsar": {
		"lat": 18.502167,
        "lon": 73.927456, 
	},
	"katraj": {
		"lat": 18.459869,
        "lon": 73.852306, 
	},
	"manjri": {
		"lat": 18.526778,
		"lon": 73.975028,
	},
	"pashan": {
		"lat": 18.536428,
		"lon": 73.805453,
	},
	"nigdi":  {
                 "lat":18.6571,
		 "lon":73.7659,
       },
       "bhumkar-chowk": {
		 "lat": 18.606219,  
		 "lon": 73.750022,
       },

	"Alandi": {
		 "lat": 18.673708, 
		 "lon": 73.891506,
       },	
	
}


def write_data():
	file_name = 'weather_data_'
	for station in station_info:
		f = None
		if os.path.exists(os.getcwd() + '\\' + file_name + station + '.csv'):
			# don't append headers
			print 'file ' + file_name + station + '.csv' + ' already present, resuming writing'
			f = open(file_name + station + '.csv', 'a+')
		else:
			# append headers
			print 'file not present, creating file: ' + file_name + station + '.csv'
			f = open(file_name + station + '.csv', 'a+')
			append_headers(f)
		json_response = get_json(station_info[station])
		if json_response['status'] == 'ok':
			print 'HTTP response OK. Collecting data for ' + station + ' at time ' + current_timestamp()
			row_string = '{0}, {1}, {2}, {3}, {4}, {5}, {6}, {7}, {8}\n'.format(current_timestamp(), json_response['data']['aqi'], 
							json_response['data']['iaqi']['co']['v'], json_response['data']['iaqi']['h']['v'], json_response['data']['iaqi']['no2']['v'],
							json_response['data']['iaqi']['o3']['v'], json_response['data']['iaqi']['pm10']['v'], json_response['data']['iaqi']['pm25']['v'],
							json_response['data']['iaqi']['t']['v'])
			f.write(row_string)
		else:
			with open('weather_data_log.txt', 'a+') as error:
				error.write(json_response)
				error.close()
		f.close()

def nl():
	print '*' * 75

if __name__ == '__main__':
	nl()
	print 'Running script to collect data from: http://api.waqi.info/feed/geo:18.526778;73.975028'
        
	nl()
	time.sleep(3)
	while (True):
		write_data()
		nl()
		print 'Iteration completed, sleeping for 1 hour'
		nl()
		time.sleep(3600)
