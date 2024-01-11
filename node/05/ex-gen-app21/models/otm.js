'use strict';
module.exports = (sequelize, DataTypes) => {
  const Otm = sequelize.define('Otm',{
    seUserId:{
      type: DataTypes.INTEGER,
      validate:{
        notEmpty:{
          msg: "送信者は必須です"
        }
      }
    },
    reUserId:{
      type: DataTypes.INTEGER,
      validate:{
        notEmpty:{
          msg: "受信者は必須です"
        }
      }
    },
    message: {
      type: DataTypes.TEXT,
      validate: {
        notEmpty: {
          msg: "メッセージは必須です"
        }
      }
    }
  },{});
  Otm.associate = function(models){
    Otm.belongsTo(models.User);
  };
  return Otm;
};