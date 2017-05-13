using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace DriveCX.Models
{
    public class Result
    {
        public int ID { get; set; }
        public string f_name { get; set; }
        public string l_name { get; set; }
        public string email { get; set; }
        public string companyName { get; set; }
        
        public double averageSalesWeek { get; set; }
        public double quickRating { get; set; }
        public double annualVIPsignups { get; set; }
        public double annualRTRoffers { get; set; }
        public double additionAnnualSales { get; set; }
        public double additionMonthlySales { get; set; }
        public double repeatCustomers { get; set; }
        public double roi { get; set; }
    }
}
