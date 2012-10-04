using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Net;

namespace hyper
{
    public partial class login : Form
    {
        static string url = "http://cg3002-18-z.comp.nus.edu.sg";
        public login()
        {
            InitializeComponent();
        }
        private void button1_Click(object sender, EventArgs e)
        {
            //create the constructor with post type and few data
            MyWebRequest myRequest = new MyWebRequest(url+"/api/login.php", "POST", "p_id=" + textBox1.Text + "&password=" + textBox2.Text);
            //show the response string on the console screen.
            string res=myRequest.GetResponse();
            if (res== "fail")
            {
                Console.WriteLine("No such Store Manager");
                label3.Text = "No such Store Manager";
            }
            else
            {
                Console.WriteLine(res);
                label3.Text = "";
                Form syncForm = new sync(res);
                syncForm.Show();
                syncForm.Activate();
            }
        } 
    }
}

