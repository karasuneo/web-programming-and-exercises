
model Markdata {
  id Int @id @default(autoincrement())
  title String
  content String
  account User @relation(fields: [accountId], references: [id])
  accountId Int 
  createdAt DateTime @default(now())
  updatedAt DateTime @updatedAt
}





