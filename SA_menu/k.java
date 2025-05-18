import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class k {
    public static void main(String[] args) {
        // window
        JFrame frame = new JFrame("用戶登入");
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setSize(300, 200);

        
        JPanel panel = new JPanel();
        frame.add(panel);
        placeComponents(panel);

        // 设置窗体在屏幕中央显示
        frame.setLocationRelativeTo(null);

        // 设置窗体可见
        frame.setVisible(true);
    }

    private static void placeComponents(JPanel panel) {
        panel.setLayout(null);

        // 创建用户名标签
        JLabel userLabel = new JLabel("帳戶名稱:");
        userLabel.setBounds(10, 20, 80, 25);
        panel.add(userLabel);

        // 创建文本域用于用户输入
        JTextField userText = new JTextField(20);
        userText.setBounds(100, 20, 165, 25);
        panel.add(userText);

        // 创建密码标签
        JLabel passwordLabel = new JLabel("密碼:");
        passwordLabel.setBounds(10, 50, 80, 25);
        panel.add(passwordLabel);

        // 创建密码域用于用户输入
        JPasswordField passwordText = new JPasswordField(20);
        passwordText.setBounds(100, 50, 165, 25);
        panel.add(passwordText);

        // 创建登录按钮
        JButton loginButton = new JButton("登入");
        loginButton.setBounds(10, 80, 80, 25);
        panel.add(loginButton);

        // 创建退出按钮
        JButton exitButton = new JButton("退出");
        exitButton.setBounds(180, 80, 80, 25);
        panel.add(exitButton);

        // 添加登录按钮事件处理
        loginButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String user = userText.getText();
                String password = new String(passwordText.getPassword());

                // 检查用户名和密码
                if (user.equals("admin") && password.equals("password")) {
                    JOptionPane.showMessageDialog(panel, "登入成功");
                } else {
                    JOptionPane.showMessageDialog(panel, "帳戶或密碼錯誤");
                }
            }
        });

        // 添加退出按钮事件处理
        exitButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                System.exit(0);
            }
        });
    }
}
/*import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class k {
    public static void main(String[] args) {
        // window
        JFrame frame = new JFrame("用戶登入");
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setSize(300, 200);

        
        JPanel panel = new JPanel();
        frame.add(panel);
        placeComponents(panel);

        // 设置窗体在屏幕中央显示
        frame.setLocationRelativeTo(null);

        // 设置窗体可见
        frame.setVisible(true);
    }

    private static void placeComponents(JPanel panel) {
        panel.setLayout(null);

        // 创建用户名标签
        JLabel userLabel = new JLabel("帳戶名稱:");
        userLabel.setBounds(10, 20, 80, 25);
        panel.add(userLabel);

        // 创建文本域用于用户输入
        JTextField userText = new JTextField(20);
        userText.setBounds(100, 20, 165, 25);
        panel.add(userText);

        // 创建密码标签
        JLabel passwordLabel = new JLabel("密碼:");
        passwordLabel.setBounds(10, 50, 80, 25);
        panel.add(passwordLabel);

        // 创建密码域用于用户输入
        JPasswordField passwordText = new JPasswordField(20);
        passwordText.setBounds(100, 50, 165, 25);
        panel.add(passwordText);

        // 创建登录按钮
        JButton loginButton = new JButton("登入");
        loginButton.setBounds(10, 80, 80, 25);
        panel.add(loginButton);

        // 创建退出按钮
        JButton exitButton = new JButton("退出");
        exitButton.setBounds(180, 80, 80, 25);
        panel.add(exitButton);

        // 添加登录按钮事件处理
        loginButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String user = userText.getText();
                String password = new String(passwordText.getPassword());

                // 检查用户名和密码
                if (user.equals("admin") && password.equals("password")) {
                    JOptionPane.showMessageDialog(panel, "登入成功");
                } else {
                    JOptionPane.showMessageDialog(panel, "帳戶或密碼錯誤");
                }
            }
        });

        // 添加退出按钮事件处理
        exitButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                System.exit(0);
            }
        });
    }
}
 */