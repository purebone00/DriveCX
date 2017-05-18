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

public class AverageCheckNumbersDoubleInvalid {
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
  public void AverageCheckNumbersDoubleValid_test() throws Exception {
	
	  driver.get(baseUrl);
	  driver.findElement(By.id("cf-averageCheck")).click();
	  driver.findElement(By.id("cf-averageCheck")).clear();
	  driver.findElement(By.id("cf-averageCheck")).sendKeys("1.0.0");
	  driver.findElement(By.id("cf-averageCustNo")).click();
	  driver.findElement(By.id("cf-averageCustNo")).clear();
	  driver.findElement(By.id("cf-averageCustNo")).sendKeys("1");
	  driver.findElement(By.id("cf-fName")).clear();
	  driver.findElement(By.id("cf-fName")).sendKeys("x");
	  driver.findElement(By.id("cf-lName")).clear();
	  driver.findElement(By.id("cf-lName")).sendKeys("x");
	  driver.findElement(By.id("cf-email")).clear();
	  driver.findElement(By.id("cf-email")).sendKeys("x@x.x");
	  driver.findElement(By.id("cf-companyName")).clear();
	  driver.findElement(By.id("cf-companyName")).sendKeys("x");
	  assertEquals("Please enter a valid number e.g. 5.2", driver.findElement(By.cssSelector("li")).getText());
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
