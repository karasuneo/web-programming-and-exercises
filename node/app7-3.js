
model Board {
  id Int @id @default(autoincrement())
  message String
  account User @relation(fields: [accountId], references: [id])
  accountId Int
  createdAt DateTime @default(now())
  updatedAt DateTime @updatedAt
}





