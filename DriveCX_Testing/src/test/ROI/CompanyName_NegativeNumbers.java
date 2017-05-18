//DEPRECATED, REMOVED ADD BUTTON, no longer possible for admin to delete themselves
//Requirements: 3911ERD_ver09

package test.ROI;

import java.util.regex.Pattern;
import java.util.concurrent.TimeUnit;
import org.junit.*;
import static org.junit.Assert.*;
import static org.hamcrest.CoreMatchers.*;
import org.openqa.selenium.*;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.support.ui.Select;

import java.util.regex.Pattern;
import java.util.concurrent.TimeUnit;
import org.junit.*;
import static org.junit.Assert.*;
import static org.hamcrest.CoreMatchers.*;
import org.openqa.selenium.*;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.support.ui.Select;

public class verify_Lastname {
  private WebDriver driver;
  private String baseUrl;
  private boolean acceptNextAlert = true;
  private StringBuffer verificationErrors = new StringBuffer();

  @Before
  public void setUp() throws Exception {
	  
	  String exePath = "C:\\chromedriver.exe";
		System.setProperty("webdriver.chrome.driver", exePath);
		driver = new ChromeDriver();
    
    baseUrl = "https://www.vince.life/drive_static/";
   
    
  }

  @Test
  public void verify_FirstName_test() throws Exception {
	
	  driver.get(baseUrl);
	  driver.findElement(By.id("cf-fName")).clear();
	  driver.findElement(By.id("cf-fName")).sendKeys("vince");
	  driver.findElement(By.cssSelector("div.row > div.row > div.col-md-6 > div")).click();
	  driver.findElement(By.name("cf-submitted")).click();
	  driver.findElement(By.id("cf-averageCheck")).clear();
	  driver.findElement(By.id("cf-averageCheck")).sendKeys("1");
	  driver.findElement(By.id("cf-averageCustNo")).clear();
	  driver.findElement(By.id("cf-averageCustNo")).sendKeys("1");
	  driver.findElement(By.id("cf-lName")).clear();
	  driver.findElement(By.id("cf-lName")).sendKeys("w");
	  driver.findElement(By.id("cf-email")).clear();
	  driver.findElement(By.id("cf-email")).sendKeys("w@w.ca");
	  driver.findElement(By.id("cf-companyName")).clear();
	  driver.findElement(By.id("cf-companyName")).sendKeys("company");
	  driver.findElement(By.name("cf-submitted")).click();
	  try {
	    assertEquals("First name: vince", driver.findElement(By.xpath("//p[5]")).getText());
	  } catch (Error e) {
	    verificationErrors.append(e.toString());
	  }
  }

  @After
  public void tearDown() throws Exception {
    driver.quit();
    String verificationErrorString = verificationErrors.toString();
    if (!"".equals(verificationErrorString)) {
      fail(verificationErrorString);
    }
  }

  private boolean isElementPresent(By by) {
    try {
      driver.findElement(by);
      return true;
    } catch (NoSuchElementException e) {
      return false;
    }
  }

  private boolean isAlertPresent() {
    try {
      driver.switchTo().alert();
      return true;
    } catch (NoAlertPresentException e) {
      return false;
    }
  }

  private String closeAlertAndGetItsText() {
    try {
      Alert alert = driver.switchTo().alert();
      String alertText = alert.getText();
      if (acceptNextAlert) {
        alert.accept();
      } else {
        alert.dismiss();
      }
      return alertText;
    } finally {
      acceptNextAlert = true;
    }
  }
}

