using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Net;
using System.IO;
using System.Timers;

namespace hyper
{
    public partial class sync : Form
    {
        private static string s_id;
        System.Timers.Timer aTimer;
        static string foldername="";
        static string pricefolder;
        static string transfolder;
        static string url = "http://cg3002-18-z.comp.nus.edu.sg";
        
        public sync(string res)
        {
            InitializeComponent();
            s_id = res;
        }
        private void button1_Click(object sender, EventArgs e)
        {
            if (foldername == "") MessageBox.Show("Please Enter the folder name");
            else
            {
                // used to build entire input
                StringBuilder sb = new StringBuilder();

                // used on each read operation
                byte[] buf = new byte[8192];

                // prepare the web page we will be asking for
                HttpWebRequest request = (HttpWebRequest)
                    WebRequest.Create(url+"/api/price.php?s_id="+s_id);

                // execute the request
                HttpWebResponse response = (HttpWebResponse)
                    request.GetResponse();

                // we will read data via the response stream
                Stream resStream = response.GetResponseStream();

                string tempString = null;
                int count = 0;

                do
                {
                    // fill the buffer with data
                    count = resStream.Read(buf, 0, buf.Length);

                    // make sure we read some data
                    if (count != 0)
                    {
                        // translate from bytes to ASCII text
                        tempString = Encoding.ASCII.GetString(buf, 0, count);

                        // continue building the string
                        sb.Append(tempString);
                    }
                    Console.WriteLine(count);
                }
                while (count > 0); // any more data to read?

                // Write the string to a file.
                System.IO.StreamWriter file2 = new System.IO.StreamWriter(pricefolder);
                file2.Write(sb.ToString());

                file2.Close();
                MessageBox.Show("Finished Price Syncrnization");
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (foldername == "") MessageBox.Show("Please Enter the folder name");
            else
            {
                string newFile = "";
                string[] file = File.ReadAllLines(transfolder);

                foreach (string line in file)
                {
                    string[] words = line.Split(' ');
                    Console.WriteLine("Barcode:" + words[0]);
                    Console.WriteLine("Quantity:" + words[1]);
                    Console.WriteLine("Profits:" + words[2]);
                    Console.WriteLine("Transaction Id:" + words[3]);
                    Console.WriteLine("Time:" + words[4] + ' ' + words[5]);
                    if (words[6] == "0")
                    {
                        //create the constructor with post type and few data
                        MyWebRequest myRequest = new MyWebRequest(url+"/api/transaction.php", "POST", "s_id=" + s_id + "&i_id=" + words[0] + "&quantity=" + words[1] + "&profit=" + words[2] + "&trans_id=" + words[3] + "&trans_time=" + words[4] + " " + words[5]);
                        //show the response string on the console screen.
                        Console.WriteLine(myRequest.GetResponse());
                        words[6] = "1";
                        newFile += String.Join(" ", words);
                        newFile += "\r\n";
                        continue;
                    }

                    newFile += (line + "\r\n");

                }

                MessageBox.Show("Finished Transaction Syncrnization");
                File.WriteAllText(transfolder, newFile.ToString());
            }
        }

        private void button3_Click(object sender, EventArgs e)
        {
            if (foldername == "") MessageBox.Show("Please Enter the folder name");
            else if (textBox1.Text == "") MessageBox.Show("Please Enter the Syncronization Time Interval");
            else
            {
                MessageBox.Show("Syncronization Started " + DateTime.Now + ". System Automatically Syncronize Every " + textBox1.Text + " Seconds.");
                int interval = Convert.ToInt32(textBox1.Text);
                aTimer = new System.Timers.Timer();
                aTimer.Elapsed += new ElapsedEventHandler(OnTimedEvent);
                aTimer.Interval = interval * 1000;
                aTimer.Enabled = true;      
            }
        }
        // Specify what you want to happen when the Elapsed event is raised.
        private static void OnTimedEvent(object source, ElapsedEventArgs e)
        {
            string newFile = "";
            string[] file = File.ReadAllLines(transfolder);
            foreach (string line in file)
            {
                string[] words = line.Split(' ');
                if (words[6] == "0")
                {
                    //create the constructor with post type and few data
                    MyWebRequest myRequest = new MyWebRequest(url+"/api/transaction.php", "POST", "s_id=" + s_id + "&i_id=" + words[0] + "&quantity=" + words[1] + "&profit=" + words[2] + "&trans_id=" + words[3] + "&trans_time=" + words[4] + " " + words[5]);
                    //show the response string on the console screen.
                    Console.WriteLine(myRequest.GetResponse());
                    words[6] = "1";
                    newFile += String.Join(" ", words);
                    newFile += "\r\n";
                    continue;
                }

                newFile += (line + "\r\n");

            }

            File.WriteAllText(transfolder, newFile.ToString());
            // used to build entire input
            StringBuilder sb = new StringBuilder();

            // used on each read operation
            byte[] buf = new byte[8192];

            // prepare the web page we will be asking for
            HttpWebRequest request = (HttpWebRequest)
                WebRequest.Create(url+"/api/price.php?s_id="+s_id);

            // execute the request
            HttpWebResponse response = (HttpWebResponse)
                request.GetResponse();

            // we will read data via the response stream
            Stream resStream = response.GetResponseStream();

            string tempString = null;
            int count = 0;

            do
            {
                // fill the buffer with data
                count = resStream.Read(buf, 0, buf.Length);

                // make sure we read some data
                if (count != 0)
                {
                    // translate from bytes to ASCII text
                    tempString = Encoding.ASCII.GetString(buf, 0, count);

                    // continue building the string
                    sb.Append(tempString);
                }
            }
            while (count > 0); // any more data to read?

            // Write the string to a file.
            System.IO.StreamWriter file2 = new System.IO.StreamWriter(pricefolder);
            file2.Write(sb.ToString());

            file2.Close();
            Console.WriteLine(sb.ToString());
        }

        private void button4_Click(object sender, EventArgs e)
        {
            if (foldername == "") MessageBox.Show("Please Enter the folder name");
            else
            {
                aTimer.Stop();
                MessageBox.Show("Syncronization Stopped.");
            }
        }

        private void button5_Click(object sender, EventArgs e)
        {
            foldername = textBox2.Text;
            pricefolder = foldername + "/price.txt";
            transfolder = foldername + "/transaction.txt";
            MessageBox.Show("Confirmed");
        }
    }
    public class MyWebRequest
    {
        private WebRequest request;
        private Stream dataStream;

        private string status;

        public String Status
        {
            get
            {
                return status;
            }
            set
            {
                status = value;
            }
        }

        public MyWebRequest(string url)
        {
            // Create a request using a URL that can receive a post.

            request = WebRequest.Create(url);
        }

        public MyWebRequest(string url, string method)
            : this(url)
        {

            if (method.Equals("GET") || method.Equals("POST"))
            {
                // Set the Method property of the request to POST.
                request.Method = method;
            }
            else
            {
                throw new Exception("Invalid Method Type");
            }
        }

        public MyWebRequest(string url, string method, string data)
            : this(url, method)
        {

            // Create POST data and convert it to a byte array.
            string postData = data;
            byte[] byteArray = Encoding.UTF8.GetBytes(postData);

            // Set the ContentType property of the WebRequest.
            request.ContentType = "application/x-www-form-urlencoded";

            // Set the ContentLength property of the WebRequest.
            request.ContentLength = byteArray.Length;

            // Get the request stream.
            dataStream = request.GetRequestStream();

            // Write the data to the request stream.
            dataStream.Write(byteArray, 0, byteArray.Length);

            // Close the Stream object.
            dataStream.Close();

        }

        public string GetResponse()
        {
            // Get the original response.
            WebResponse response = request.GetResponse();

            this.Status = ((HttpWebResponse)response).StatusDescription;

            // Get the stream containing all content returned by the requested server.
            dataStream = response.GetResponseStream();

            // Open the stream using a StreamReader for easy access.
            StreamReader reader = new StreamReader(dataStream);

            // Read the content fully up to the end.
            string responseFromServer = reader.ReadToEnd();

            // Clean up the streams.
            reader.Close();
            dataStream.Close();
            response.Close();

            return responseFromServer;
        }

    }
}
