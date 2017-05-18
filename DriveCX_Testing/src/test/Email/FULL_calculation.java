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

public class FULL_calculation {
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
  public void FULL_calculation_test() throws Exception {
	
	  driver.get(baseUrl + "/?gws_rd=ssl");
	  driver.findElement(By.linkText("Gmail")).click();
	  driver.findElement(By.id("identifierId")).clear();
	  driver.findElement(By.id("identifierId")).sendKeys("team43bcit");
	  driver.findElement(By.cssSelector("div.ZFr60d.CeoRYc")).click();
	  driver.findElement(By.name("password")).click();
	  driver.findElement(By.name("password")).clear();
	  driver.findElement(By.name("password")).sendKeys("passwordbcit");
	  driver.findElement(By.cssSelector("span.RveJvd.snByac")).click();

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

