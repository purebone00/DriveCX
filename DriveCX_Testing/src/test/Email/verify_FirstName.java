//DEPRECATED, REMOVED ADD BUTTON, no longer possible for admin to delete themselves
//Requirements: 3911ERD_ver09

package test.Email;

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

public class verify_FirstName {
  private WebDriver driver;
  private String baseUrl;
  private boolean acceptNextAlert = true;
  private StringBuffer verificationErrors = new StringBuffer();

  @Before
  public void setUp() throws Exception {
	  
	System.setProperty("webdriver.gecko.driver","c:\\geckodriver.exe");
   driver = new FirefoxDriver();
    
    baseUrl = "http://vince.life/vince.life/joe/";
    driver.manage().timeouts().implicitlyWait(30, TimeUnit.SECONDS);
    
  }

  @Test
  public void verify_FirstName_test() throws Exception {
	
	  driver.get(baseUrl);
	  
	  driver.findElement(By.id("cf-fName")).clear();
	  driver.findElement(By.id("cf-fName")).sendKeys("mike");
	  driver.findElement(By.name("cf-submitted")).click();
	  driver.findElement(By.cssSelector("div.aio.UKr6le")).click();
	  driver.findElement(By.id("advancedButton")).click();
	  driver.findElement(By.id("exceptionDialogButton")).click();
	  try {
	    assertEquals("mike x", driver.findElement(By.cssSelector("span > span")).getText());
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

