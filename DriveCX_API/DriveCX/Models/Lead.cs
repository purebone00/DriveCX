using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace DriveCX.Models
{
    public class Lead
    {
        public int ID { get; set; }
        public bool fullService { get; set; }
        public double avg_custNo { get; set; }
        public double avg_check { get; set; }
        public string f_name { get; set; }
        public string l_name { get; set; }
        public string email { get; set; }
        public string companyName { get; set; }
    }
}
