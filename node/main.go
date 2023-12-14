package main

import (
	"bufio"
	"fmt"
	"os"
	"regexp"
	"strings"
)

func main() {
	// 入力ファイル名
	inputFileName := "sample.txt"

	// ファイルを開く
	file, err := os.Open(inputFileName)
	if err != nil {
		fmt.Println("ファイルのオープンエラー:", err)
		return
	}
	defer file.Close()

	// ファイルをスキャンしてJSまたはHTMLファイルを生成
	scanner := bufio.NewScanner(file)
	var scriptContent string
	var outputFileName string

	for scanner.Scan() {
		line := scanner.Text()

		// ファイル名の抽出
		match := extractFileName(line)
		if match != "" {
			// 前回までの内容を出力
			if scriptContent != "" && outputFileName != "" {
				generateFile(outputFileName, scriptContent)
			}

			// 新しいファイル名を取得
			outputFileName = fmt.Sprintf("app%s", match)

			// JSまたはHTMLファイルの中身を初期化
			scriptContent = ""
		} else {
			// JSまたはHTMLファイルの中身を追加
			scriptContent += line + "\n"
		}
	}

	// 最後のJSまたはHTMLファイルを生成
	if scriptContent != "" && outputFileName != "" {
		generateFile(outputFileName, scriptContent)
	}
}

// ファイル名の抽出
func extractFileName(line string) string {
	re := regexp.MustCompile(`▼リスト(\d+-\d+)`)
	match := re.FindStringSubmatch(line)
	if len(match) == 2 {
		return match[1]
	}
	return ""
}

// JSまたはHTMLファイルの生成
func generateFile(fileName, content string) {
	// ファイルがHTML形式で始まるかどうかの判定
	isHTML := strings.HasPrefix(content, "<!DOCTYPE html>")

	// 拡張子を選択
	var fileExt string
	switch {
	case isHTML && strings.Contains(content, "ejs"):
		fileExt = ".ejs"
	case isHTML:
		fileExt = ".html"
	default:
		fileExt = ".js"
	}

	// ファイルの作成
	file, err := os.Create(fileName + fileExt)
	if err != nil {
		fmt.Println("ファイルの作成エラー:", err)
		return
	}
	defer file.Close()

	// ファイルの中身を書き込む
	file.WriteString("\n")
	file.WriteString(content)
	file.WriteString("\n")

	fmt.Printf("%sファイルを生成しました: %s%s\n", fileExt, fileName, fileExt)
}
