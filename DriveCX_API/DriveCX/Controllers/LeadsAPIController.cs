using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using DriveCX.Data;
using DriveCX.Models;

namespace DriveCX.Controllers
{
    [Produces("application/json")]
    [Route("api/leads")]
    public class LeadsAPIController : Controller
    {
        private readonly ApplicationDbContext _context;

        public LeadsAPIController(ApplicationDbContext context)
        {
            _context = context;
        }

        // GET: api/LeadsAPI
        [HttpGet]
        public IEnumerable<Lead> GetLead()
        {
            return _context.Lead;
        }

        // GET: api/LeadsAPI/5
        [HttpGet("{id}")]
        public async Task<IActionResult> GetLead([FromRoute] int id)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            var lead = await _context.Lead.SingleOrDefaultAsync(m => m.ID == id);

            if (lead == null)
            {
                return NotFound();
            }

            return Ok(lead);
        }

        // GET: /api/leads/roi
        [Route("roi")]
        [HttpPost]
        public IActionResult GetQuickROI([FromBody] Lead lead)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            

            if (lead == null)
            {
                return NotFound();
            }

            //get lead

            Result result = new Result();


            bool fullService = lead.fullService;

            double driveSubCost = 199;
		    double quickRatingPercent = (fullService ? 0.5 : 0.67);
            double completeSurveyPercent = (fullService ? 0.3 : 0.38);
		    double vipPercentile = (fullService ? 0.06 : 0.22);
		    double offersSentPercentile = 0.29;
		    double rtrPercentile = (fullService ? 0.05 : 0.25);
		    double vipEngagment = 0.25;
            double additionVisits = (fullService ? 4 : 12);
            double avgTableSize = (fullService ? 3 : 1);


            result.f_name = lead.f_name;
            result.l_name = lead.l_name;
            result.email = lead.email;
            result.companyName = lead.companyName;

            result.averageSalesWeek = lead.avg_check * lead.avg_custNo;
            result.quickRating = (quickRatingPercent * lead.avg_custNo) / avgTableSize;
            result.annualVIPsignups = result.quickRating * vipPercentile * 52;
            result.annualRTRoffers = result.quickRating * completeSurveyPercent * (lead.fullService ? 1 : offersSentPercentile) * rtrPercentile * 52;
            result.additionAnnualSales = (result.annualVIPsignups * lead.avg_check * avgTableSize * vipEngagment * additionVisits);
            result.additionMonthlySales = result.additionAnnualSales / 12;
            result.repeatCustomers = result.annualVIPsignups * vipEngagment;
            result.roi = result.additionAnnualSales / (driveSubCost * 12);

            return Ok(result);
        }



        // PUT: api/LeadsAPI/5
        [HttpPut("{id}")]
        public async Task<IActionResult> PutLead([FromRoute] int id, [FromBody] Lead lead)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != lead.ID)
            {
                return BadRequest();
            }

            _context.Entry(lead).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!LeadExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/LeadsAPI
        [HttpPost]
        public async Task<IActionResult> PostLead([FromBody] Lead lead)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            _context.Lead.Add(lead);
            await _context.SaveChangesAsync();

            return CreatedAtAction("GetLead", new { id = lead.ID }, lead);
        }

        // DELETE: api/LeadsAPI/5
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteLead([FromRoute] int id)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            var lead = await _context.Lead.SingleOrDefaultAsync(m => m.ID == id);
            if (lead == null)
            {
                return NotFound();
            }

            _context.Lead.Remove(lead);
            await _context.SaveChangesAsync();

            return Ok(lead);
        }

        private bool LeadExists(int id)
        {
            return _context.Lead.Any(e => e.ID == id);
        }
    }
}