package main

import (
    "fmt"
    "os"
)

func main() {
    for i := 15; i <= 21; i++ {
        // ファイル名を作成
        fileName := fmt.Sprintf("sample12-%d.php", i)

        // ファイルを作成または既存のファイルを上書き
        file, err := os.Create(fileName)
        if err != nil {
            fmt.Printf("ファイル %s を作成できませんでした: %v\n", fileName, err)
            return
        }
        defer file.Close()

        // ファイルに内容を書き込む
        _, err = file.WriteString(fmt.Sprintf("これはファイル %d です。\n", i))
        if err != nil {
            fmt.Printf("ファイル %s に書き込めませんでした: %v\n", fileName, err)
        } else {
            fmt.Printf("ファイル %s を作成しました。\n", fileName)
        }
    }
}
