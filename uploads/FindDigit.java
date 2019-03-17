import java.io.*;
import java.util.*;
import java.text.*;
import java.math.*;
import java.util.regex.*;

class FindDigit {
	public static void main(String args[])
	{
		Scanner in = new Scanner(System.in);
		int t; 
		t=in.nextInt();
		for(int a0 = 0; a0 < t; a0++){
			int n, r, m, c=0; 
			n=in.nextInt();
			m=n;
			while(n!=0)
				{
				r=n%10;
				if(r!=0 && (m%r)==0)
					c++;
				n=n/10;
			}
			System.out.println(""+c);
		}
	}
}